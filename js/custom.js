// let url = 'form.php'
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
      // console.log('продукт ' + data + ' добавлен в каталог')
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
        document.location.href = "/php_diplom/products/index.php";
      } else {
        document.location.href = "/php_diplom/products/orders.php";
      }

    },
    error: function (jqXHR, textStatus, errorThrown) {
      response.innerHTML = 'произошла ошибка, попробуйте снова'
      console.log('ERROR ' + errorThrown + jqXHR);
    }
  })
})

function getCounter() {
  let productsOnPage = document.querySelectorAll('.product')
  let counter = productsOnPage.length
  document.querySelector(".res-sort").innerHTML = counter
}
getCounter()


// переделать!!!
$('#sortBy').change(function () {
  let sort = $(this).val();
  $.get("./include/productsFilter.php", sort);

})


$('#sortOrder').change(function (e) {
  e.preventDefault();
  console.log('ok');
})
let url1 = '';
$('.filter__list-item').click(function (e) {
  e.preventDefault();
  $(this).addClass('active');
  let category = this.getAttribute('name')
  if (category > 0) {
    url1 = `category=${category}&`;
  }

  return url1;
})




$('#filter-button').click(function (e) {
  e.preventDefault()

  let minP = parseInt($('.min-price').text())
  let maxP = parseInt($('.max-price').text())
  let filtNew = 0
  let filtSale = 0
  if ($('#new').is(':checked')) {
    filtNew = 1;
  }
  if ($('#sale').is(':checked')) {
    filtSale = 1;
  }
  filter = url1 + 'min=' + minP + '&max=' + maxP + '&new=' + filtNew + '&sale=' + filtSale
  console.log(filter)
  $.ajax({
    url: '/php_diplom/include/productsFilter.php',
    data: filter,
    type: 'get',
    success: function (html) {
      $('.shop__list').html(html).hide().fadeIn(1000);

    }
  })

})

