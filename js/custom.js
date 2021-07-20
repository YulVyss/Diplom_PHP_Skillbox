// форма добавления товара в БД во вкладке администратора
$("#addProduct").submit(function (e) {
  e.preventDefault();
  if ($('#category').val() === null) {
    return alert('Выберите категорию товара')
  }
  if ($('#product-photo').val() === '') {
    return alert('Выберите изображение товара')
  }

  let form = document.getElementById('addProduct')
  let product = new FormData(form)
  let cat = []
  $('#category').each(function () {
    cat.push($(this).val());
  });
  product.append('add', 'product')
  product.append('category', cat)

  $.ajax({
    type: "POST",
    url: 'form.php',
    data: product,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (data) {
      const prodName = document.querySelector('.product__added')
      const popupEnd = document.querySelector('.page-add__popup-end')

      if (data.status == 'ok') {
        console.log(data.status)
        form.hidden = true;
        prodName.innerHTML = `${data.product_name}`
        popupEnd.hidden = false;
      } else {
        alert('Произошла ошибка: ' + data.error)
      }
    },
    error: function (errorThrown) {
      alert('ERROR ' + errorThrown);
    }
  })
})

// форма авторизации на сайте
$("#authorization").submit(function (e) {
  e.preventDefault();
  let form = document.getElementById('authorization')
  let authorization = new FormData(form)
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
      } else if (data === 2) {
        document.location.href = "/products/orders.php";
      } else {
        document.location.href = "/";
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
  query += "&aside=button"
  sendReq(query)
})

// выбор категории товаров
$('.filter__list-item').click(function (e) {
  e.preventDefault();
  clearUrl()

  $('.active').removeClass('active');
  $(this).addClass('active');
  let category = parseInt(this.getAttribute('name'))
  filter = `categoryChange=${category}`;
  // очистка сортировки
  $('#sortBy').val('Сортировка')
  $('#sortOrder').val('Порядок')
  const url = window.location.href.split("/")[3];
  // очистка чекбоксов
  if (url === "sale.php") {
    filter += '&sale=1'
  } else {
    $('#sale').removeAttr('checked');
  }
  if (url === "new.php") {
    filter += '&new=1'
  } else {
    $('#new').removeAttr('checked');
  }
  // сброс диапазона цен
  const initialMinimumValue = parseInt($('.min-range').attr('data-val'))
  const initialMaximumValue = parseInt($('.max-range').attr('data-val'))
  changeRange(initialMinimumValue, initialMaximumValue)

  sendReq(filter)
})

// фильтрация товаров по нажатию кнопки 'Применить'
$('#filter-button').click(function (e) {
  e.preventDefault()
  let query = makeReq()
  query += "&aside=button"
  console.log(query)
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
  let category = parseInt(document.querySelector('.filter__list-item.active').getAttribute('name'))
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
    'min': minP,
    'max': maxP,
    'new': filtNew,
    'sale': filtSale,
    'sort': sort,
    'order': order,
  }
  if (category > 0) {
    filter = {
      'category': category,
      'min': minP,
      'max': maxP,
      'new': filtNew,
      'sale': filtSale,
      'sort': sort,
      'order': order,
    }
  }

  let esc = encodeURIComponent;
  let query = Object.keys(filter)
    .map(k => esc(k) + '=' + esc(filter[k]))
    .join('&');
  console.log(query)
  return query
}

// изменение пагинации в соответсвии с запросом
function showPagination(num, query) {
  let ul = document.querySelector('.shop__paginator.paginator')
  ul.innerHTML = ''
  for (let i = 1; i <= num; i++) {
    let li = document.createElement('li')
    let a = document.createElement('a')
    if (window.location.pathname === "/new.php") {
      a.setAttribute('href', '/new.php?page=' + i + '&' + query)
    } else if (window.location.pathname === "/sale.php") {
      a.setAttribute('href', '/sale.php?page=' + i + '&' + query)
    } else {
      a.setAttribute('href', '/?page=' + i + '&' + query)
    }

    a.classList.add('paginator__item')
    a.innerHTML = i
    li.appendChild(a)
    ul.appendChild(li)
  }
}

if (window.location.pathname === "/new.php") {
  $('#new').attr('checked', 'checked')
  $('#sale').removeAttr('checked')
}
if (window.location.pathname === "/sale.php") {
  $('#sale').attr('checked', 'checked')
  $('#new').removeAttr('checked')
}


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
$('#changeProduct').submit(function (e) {
  e.preventDefault();
  const urlParams = new URLSearchParams(location.search);
  for (const [key, value] of urlParams) {
    if (`${key}` === 'id') {
      id = parseInt(`${value}`)
    }
  }
  let form = document.querySelector('#changeProduct')
  let product = new FormData(form)
  let cat = []
  $('#category').each(function () {
    cat.push($(this).val());
  })
  product.append('category', cat)
  product.append('id', id)
  product.append('change', 'product')
  for (let [name, value] of product) {
    console.log(`${name} = ${value}`);
  }
  const prodName = document.querySelector('.product__added')
  const popupEnd = document.querySelector('.page-add__popup-end')

  $.ajax({
    type: "POST",
    url: '/products/form.php',
    data: product,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (data) {
      const prodName = document.querySelector('.product__added')
      const popupEnd = document.querySelector('.page-add__popup-end')
      console.log(data);
      if (data.status == 'ok') {
        form.hidden = true;
        prodName.innerHTML = `${data.product_name}`
        popupEnd.hidden = false;
      } else {
        alert('ошибка загрузки: ' + data.error)
      }
    },
    error: function (jqXHR, errorThrown) {
      alert('ошибка ' + errorThrown);
      console.log("Ошибка")
    }
  })
})

// оформление заказа
$('#btn-order').click(function (e) {
  e.preventDefault()
  const form = $('#order')[0];
  const data = new FormData(form);
  for (let [name, value] of data) {
    console.log(`${name} = ${value}`);
  }
  const popupEnd = document.querySelector('.shop-page__popup-end');
  const shopOrder = document.querySelector('.shop-page__order');

  $.ajax({
    url: '/products/form.php',
    data: data,
    dataType: 'json',
    type: 'post',
    contentType: false,
    processData: false,
    success: function (data) {
      console.log(data.status == 'ok')
      if (data.status == 'ok' && parseInt(data.productPrice) > 0) {
        $('.order-summ').html(`${data.productPrice}`)
        toggleHidden(shopOrder, popupEnd);
        popupEnd.classList.add('fade');
        setTimeout(() => popupEnd.classList.remove('fade'), 1000);
        $('#order')[0].reset()
      } else {
        alert("Произошла ошибка: " + data.status)
      }

    },
    error: function (jqXHR, errorThrown) {
      alert('Произошла ошибка при отправке данных')
      console.log('ERROR ' + errorThrown);
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
      console.log(`${data}`)
    }
  })
}

// настройка полосы диапазона цен при смене страниц
function changeRange(min, max) {
  $(".range__line").slider("option", "values", [min, max]);
  $('.min-price').text($('.range__line').slider('values', 0) + ' руб.');
  $('.max-price').text($('.range__line').slider('values', 1) + ' руб.');
}
const urlParams = new URLSearchParams(location.search);
if (urlParams.has('min') && urlParams.has('max')) {
  let min = urlParams.get('min')
  let max = urlParams.get('max')
  changeRange(min, max)
}
