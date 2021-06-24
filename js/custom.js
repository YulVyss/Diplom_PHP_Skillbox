// форма добавления товара в БД
let form = document.getElementById('addProduct')
let btn = document.querySelector('.addProduct')

$("#addProduct").submit(function (e) {
  e.preventDefault();
  let product = new FormData(form)
  //просмотр данных о продукте в консоли
  // for (let [name, value] of product) {
  //   console.log(`${name} = ${value}`);
  // }
  $.ajax({
    type: "POST",
    url: 'form.php',
    data: product,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (data) {
      form.hidden = true;
      const prodName = document.querySelector('.product__added')
      const popupEnd = document.querySelector('.page-add__popup-end')
      prodName.innerHTML = `${data}`
      popupEnd.hidden = false;
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log('ERROR ' + errorThrown + jqXHR);
    }
  })
})

// форма авторизации на сайте
$("#authorization").submit(function (e) {
  e.preventDefault();
  let form = document.getElementById('authorization')
  let authorization = new FormData(form)
  // for (let [name, value] of authorization) {
  //   console.log(`${name} = ${value}`);
  // }
  let response = document.querySelector('.response')
  $.ajax({
    type: "POST",
    url: '../include/login.php',
    data: authorization,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (data) {
      if (data == 'false') {
        response.innerHTML = 'не верно введен логин и/или пароль, попробуйте снова'
      } else if (data === 1) {
        document.location.href = "/products/index.php";
      } else {
        document.location.href = "/products/orders.php";
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      response.innerHTML = 'произошла ошибка, попробуйте снова'
      console.log('ERROR ' + errorThrown + jqXHR);
    }
  })
})

// сортировка товаров
let filter = '';

$('#sortOrder').change(function (e) {
  e.preventDefault();
  clearUrl()
  let query = makeReq()
  sendReq(query)
})

// выбор категории товаров
$('.filter__list-item').click(function (e) {
  e.preventDefault();
  clearUrl()

  $('.active').removeClass('active');
  $(this).addClass('active');
  let category = this.getAttribute('name')
  if (category > 0) {
    filter = `category=${category}`;
  }
  // очистка сортировки
  $('#sortBy').val('Сортировка')
  $('#sortOrder').val('Порядок')
  // очистка чекбоксов
  $('#sale').attr('checked', false);
  $('#new').attr('checked', false);
  sendReq(filter)
})

// фильтрация товаров по нажатию кнопки 'Применить'
$('#filter-button').click(function (e) {
  e.preventDefault()
  let query = makeReq()
  sendReq(query)
})

// отправка запроса в БД
function sendReq(query) {
  $.ajax({
    url: '/include/productsFilter.php',
    data: query,
    type: 'get',

    success: function (html) {
      $('.shop__list').html(html).hide().fadeIn(1000);
      $('.res-sort').text($('.counter').text());
      let total = $('.res-sort').text()
      let pages = Math.ceil(total / 3)
      $('.shop__paginator.paginator').html(showPagination(pages, query))
      $('.paginator__item').first().addClass('active')
    }
  })
}

// собираем GET запрос
function makeReq() {
  let page = ($('.paginator__item.active').html() !== undefined) ? $('.paginator__item.active').html() : 1
  let category = document.querySelector('.filter__list-item.active').getAttribute('name')
  let minP = parseInt($('.min-price').text())
  let maxP = parseInt($('.max-price').text())
  let filtNew = 0
  let filtSale = 0
  if ($('#new').is(':checked')) {
    filtNew = 1
  }
  if ($('#sale').is(':checked')) {
    filtSale = 1
  }
  let sort = $('#sortBy').val()
  let order = $('#sortOrder').val()
  if (sort == 'Сортировка' && order == 'Порядок') {
    sort = ''
    order = ''
  }
  filter = {
    'category': category,
    'min': minP,
    'max': maxP,
    'new': filtNew,
    'sale': filtSale,
    'sort': sort,
    'order': order,
  }
  let esc = encodeURIComponent;
  let query = Object.keys(filter)
    .map(k => esc(k) + '=' + esc(filter[k]))
    .join('&');
  return query
}

// изменение пагинации в соответсвии с запросом
function showPagination(num, query) {
  let ul = document.querySelector('.shop__paginator.paginator')
  ul.innerHTML = ''
  for (let i = 1; i <= num; i++) {
    let li = document.createElement('li')
    let a = document.createElement('a')
    a.setAttribute('href', '/?page=' + i + '&' + query)
    a.classList.add('paginator__item')
    a.innerHTML = i
    li.appendChild(a)
    ul.appendChild(li)
  }
}

// выбор новинок по ссылке в шапке сайта
$('.new').click(function (e) {
  e.preventDefault()
  clearUrl()
  $('#new').attr('checked', 'checked')
  filtNew = 1
  filter = {
    'category': 0,
    'new': filtNew,
  }
  let esc = encodeURIComponent;
  let query = Object.keys(filter)
    .map(k => esc(k) + '=' + esc(filter[k]))
    .join('&');
  sendReq(query)
})

// выбор товаров по распродаже в шапке сайта
$('.sale').click(function (e) {
  clearUrl()
  e.preventDefault()
  $('#sale').attr('checked', 'checked')
  filtSale = 1
  filter = {
    'category': 0,
    'sale': filtSale,
  }
  let esc = encodeURIComponent;
  let query = Object.keys(filter)
    .map(k => esc(k) + '=' + esc(filter[k]))
    .join('&');
  sendReq(query)
})

function clearUrl() {
  baseUrl = window.location.href.split("?")[0];
  window.history.pushState('/', '', baseUrl);
}

// в разделе администратора удаление товара из БД
$('.product-item__delete').click(function (e) {
  const id = $(this).siblings('.product-id').text();
  let req = 'id=' + id

  $.ajax({
    url: '/products/index.php',
    data: req,
    dataType: 'json',
    type: 'post',
    success: function (html) {
      alert('товар с id=' + id + ' удален из БД')
    }
  })
})

// в разделе администратора редакторование товара
$('.product-item__edit').click(function (e) {
  e.preventDefault()
  const name = $(this).siblings('.product-item__name').text()
  const price = $(this).siblings('.product-price').text()
  const id = $(this).siblings('.product-id').text()

  let prod = `id=${id}&name=${name}&price=${price}`
  console.log(prod)
  // дописать
})

// оформление заказа
$('#btn-order').click(function (e) {
  e.preventDefault()
  const form = $('#order')[0];
  const data = new FormData(form);
  for (let [name, value] of data) {
    console.log(`${name} = ${value}`);
  }
  $.ajax({
    url: '/products/orders.php',
    data: data,
    dataType: 'json',
    type: 'post',
    contentType: false,
    processData: false,
    success: function (data) {
      console.log('ok')
    },
    error: function (jqXHR, errorThrown) {
      console.log('ERROR ' + errorThrown + jqXHR);
    }
  })
})

// изменение статуса заказа во вкладке Заказы
function changeStatus(text, id) {
  let data = {
    'statusOrder': text,
    'id': id,
  }

  $.ajax({
    url: '/products/orderChange.php',
    data: data,
    dataType: 'json',
    type: 'post',
    success: function (data) {
      console.log(data)
    }
  })
}
