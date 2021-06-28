<?php
include $_SERVER['DOCUMENT_ROOT'] . '/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/login.php';

if($_POST['add']) {
  
  $product_name = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-name']));
  $product_price = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-price']));
  $product_photo = ($_FILES ["product-photo"]['name'])?? 'product.jpg';
  $product_section = str_split($_POST['category']);
  
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
  foreach($product_section as $section) {
    addNewProduct($connect, $product_name, $product_price, $product_photo, $section, $new, $sale);
  }
  echo json_encode($product_name);
}
if($_POST['change']){
  $ID = $_POST['id'];
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
  editeProduct($connect, $ID, $product_name, $product_price, $product_photo, $new, $sale, $product_section);
  echo json_encode($product_name);
}