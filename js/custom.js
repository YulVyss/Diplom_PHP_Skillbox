let url = 'form.php'

// let btn = document.querySelector('.addProduct')
// if (btn) {
//   btn.addEventListener('click', function (e) {
//     e.preventDefault();
//     // e.stopPropagation();

//     let name = document.getElementById('product-name').value;
//     let price = document.getElementById('product-price').value;
//     let photo = document.getElementById('product-photo').value;
//     let sale = document.getElementById('sale').value;
//     let newprod = document.getElementById('new').value;
//     let product = [name, price, photo, sale, newprod]

//     fetch(url, {
//       method: 'POST',
//       dataType: 'json',
//       body: name,
//     })
//       .then(response => {
//         res = response.name
//         console.log(res)
//       })

//   })
// }

// $('button[type="submit"]').on('click', function (event) {
//   event.stopPropagation();
//   event.preventDefault();
//   let name = document.getElementById('product-name').value;
//   let price = document.getElementById('product-price').value;
//   let photo = document.getElementById('product-photo').value;
//   let sale = document.getElementById('sale').value;
//   let newprod = document.getElementById('new').value;
//   let product = [name, price, photo, sale, newprod]
//   // product.push(name, price, photo, category.value, sale, newprod);
//   console.log(product);

//   $.ajax({
//     url: url,
//     type: 'POST',
//     data: product,
//     cache: false,
//     dataType: 'json',
//     processData: false,
//     contentType: false,
//     success: function (data) {
//       console.log(data.status)
//     },
//     error: function (jqXHR, textStatus, errorThrown) {
//       console.log('ERROR ' + errorThrown);
//     }
//   })
// });