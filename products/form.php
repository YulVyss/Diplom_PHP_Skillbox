<?php
include $_SERVER['DOCUMENT_ROOT'] . '/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/login.php';

if(isset($_POST)) {

  $product_name = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-name']));
  $product_price = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-price']));
  $product_photo = ($_FILES ["product-photo"]['name'])?? 'product.jpg';
  $product_section = $_POST['category'];
  if(isset($_POST['new'])){
    $new = '1';
  } else {
    $new = '0';
  }
  if(isset($_POST['sale'])){
    $sale = 1;
  } else {
    $sale = 0;
  }
  addNewProduct($connect, $product_name, $product_price, $product_photo, $product_section, $new, $sale);
  // exit(json_encode($product_name));
  
}