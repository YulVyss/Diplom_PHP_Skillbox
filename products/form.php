<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/include/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/include/functions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/include/login.php';
// function addNewProduct($connect, $product_name, $product_price, $product_photo, $product_section, $new, $sale) {
//   if (mysqli_connect_errno()) {
//       $err = "Ошибка ".mysqli_connect_error();
//       exit();
//   } else {
//       mysqli_query($connect, "INSERT into products (name, price, activity, img, section, new, sale)
//       values ($product_name, $product_price, 1, $product_photo, $product_section, $new, $sale)");
//   }
// }
// addNewProduct($connect, 'name', 222, 'product-10.jpg', 'дети', 1, 0);
// $entityBody = file_get_contents('php://input');

// $response = [
//   'name' =>  file_get_contents('php://stdin'),
//   'price' => file_get_contents('php://input'),
//   'status' => 'ok',
// ];
// die(json_encode($response));
if(isset($_POST) && !empty($_POST['submit'])) {
//if(!empty($_POST)) {
  // $product_name = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-name']));
  // $product_price = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-price']));
  // $product_photo = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-photo']));
  // $product_section = mysqli_real_escape_string($connect, htmlspecialchars($_POST['category']));
  $product_name = htmlspecialchars($_POST['product-name']);
  $product_price = htmlspecialchars($_POST['product-price']);
  $product_photo = htmlspecialchars($_POST['product-photo']);
  $product_section = $_POST['category'];
  $new = $_POST['new'] ?? '0';
  $sale = $_POST['sale'] ?? '0';
  
  // addNewProduct($connect, $product_name, $product_price, 'product-10.jpg', $product_section, $new, $sale);
  addNewProduct($connect, 'угги', 3222, 'product-10.jpg', 'дети', 1, 0);
  // exit(json_encode($product_name));
}