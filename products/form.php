<?php
include $_SERVER['DOCUMENT_ROOT'] . '/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/login.php';

// добавление нового товара
if($_POST['add']) {
  $product_name = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-name']));
  $product_price = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-price']));
  $product_photo = ($_FILES ["product-photo"]['name'])?? 'product.jpg';
  $product_section = explode(',', $_POST['category']);
  
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

// изменение товара
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

// оформление заказа
if(isset($_POST['prod-id']) && $_POST['prod-id'] !== '') {
  $date = date("Y-m-d H:i:s");
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $thirdname = $_POST['thirdname'] ?? '';  
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $delivery = $_POST['delivery'];
  $payment = $_POST['pay'];
  $status = 'Не выполнено';
  $comments = $_POST['comment'] ?? '';
  $city = $_POST['city'] ?? '';
  $street = $_POST['street'] ?? '';
  $home = $_POST['home'] ?? '';
  $aprt = $_POST['aprt'] ?? '';
  $productId = $_POST['prod-id'];
  $productPrice = $_POST['prod-price'];
  if($name == '' || $surname == '' || $email == '' || $phone == ''){
    echo $err = 'ошибка валидации';
    exit();
  }
  if($productPrice <= $minsum && $delivery === 'Курьерная доставка') {
    $productPrice += $delivery;
  }
  addNewOrder($connect, $date, $productPrice, $name, $surname, $thirdname, $email, $phone, $delivery, $payment, $status, $comments, $city, $street, $home, $aprt, $productId);
  echo json_encode($productPrice);
}