<?php
include $_SERVER['DOCUMENT_ROOT'] . '/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/login.php';

// добавление нового товара
if(isset($_POST['add'])) {
  // var_dump($_POST);
  $product_name = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-name']));
  $product_price = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-price']));
  $product_photo = ($_FILES ["product-photo"]['name'])?? 'product.jpg';
  $product_sections = $_POST['category'];
  
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
  addNewProduct($connect, $product_name, $product_price, $product_photo, $new, $sale, $product_sections);
  echo json_encode($product_name);
}

// изменение товара
if(isset($_POST['change']) && $_POST['change'] === 'product') {
  $ID = $_POST['id'];
  $product_name = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-name']));
  $product_price = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-price']));
  if(isset($_FILES ["product-photo"]['name']) && $_FILES ["product-photo"]['name'] !== '') {
    $product_photo = $_FILES ["product-photo"]['name'];
  } else {
    $product_photo = getImage($connect, $ID);
  }
  $product_sections = $_POST['category'];
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
  editeProduct($connect, $ID, $product_name, $product_price, $product_photo, $new, $sale, $product_sections);
  echo json_encode($product_name);
}

// оформление заказа
if(isset($_POST['prod-id']) && $_POST['prod-id'] !== '') {
  $date = date("Y-m-d H:i:s");
  $name =  mysqli_real_escape_string($connect, clean($_POST['name']));
  $surname = mysqli_real_escape_string($connect, clean($_POST['surname']));
  $thirdname = mysqli_real_escape_string($connect, clean($_POST['thirdname']));
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $phone = mysqli_real_escape_string($connect, clean($_POST['phone']));
  $delivery = $_POST['delivery'];
  $payment = $_POST['pay'];
  $status = 'Не выполнено';
  $comments = mysqli_real_escape_string($connect, clean($_POST['comment'])) ?? '';
  $city = mysqli_real_escape_string($connect, clean($_POST['city'])) ?? '';
  $street = mysqli_real_escape_string($connect, clean($_POST['street'])) ?? '';
  $home = mysqli_real_escape_string($connect, clean($_POST['home'])) ?? '';
  $aprt = mysqli_real_escape_string($connect, clean($_POST['aprt'])) ?? '';
  $productId = $_POST['prod-id'];
  $productPrice = $_POST['prod-price'];
  
  if(!check_length($phone, 11, 12) || $phone === '') {
    echo json_encode($err = 'Допущена ошибка в номере телефона');
    exit();
  }
  if(!check_length($email, 5, 100) || $email === '') {
    echo json_encode($err = 'Допущена ошибка в email');
    exit();
  }
  if(!check_length($name, 2, 50) || $name === '') {
    echo json_encode($err = 'Допущена ошибка в написании имени');
    exit();
  }
  if(!check_length($surname, 2, 50)) {
    echo json_encode($err = 'Допущена ошибка в написании фамилии');
    exit();
  }
  if($productPrice <= $minsum && $delivery === 'Курьерная доставка') {
    $productPrice += $delivery;      
  }
  addNewOrder($connect, $date, $productPrice, $name, $surname, $thirdname, $email, $phone, $delivery, $payment, $status, $comments, $city, $street, $home, $aprt, $productId);
  echo json_encode($productPrice);
}