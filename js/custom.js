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

$("#authorization").submit(function (e) {
  e.preventDefault();
  let form = document.getElementById('authorization')
  let authorization = new FormData(form)
  for (let [name, value] of authorization) {
    console.log(`${name} = ${value}`);
  }
  let response = document.querySelector('.response')
  $.ajax({
    type: "POST",
    url: '../include/login.php',
    data: authorization,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (data) {
      console.log(data)
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


// фильтрация товаров по кнопке 'Применить'
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
  console.log(query)
  return query
}
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

