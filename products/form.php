<?php
include $_SERVER['DOCUMENT_ROOT'] . '/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/login.php';

// добавление нового товара
if(isset($_POST['add']) && isset($_FILES['product-photo']['tmp_name'])) {
  
  $product_name = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-name']));
  $product_price = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-price']));
  $product_photo = ($_FILES ["product-photo"]['name']);
  $product_sections = $_POST['category'];

  $photo = [];
  $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/img/products/';
  $fileTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
  $maxFileLoadSize = 5000000;
  $tmp_name = $_FILES['product-photo']['tmp_name'];
  $mime = mime_content_type($_FILES['product-photo']['tmp_name']);
  $fileName = $_FILES['product-photo']['name'];
  $response['status'] = 'bad';

  if (in_array($mime, $fileTypes) && $size <= $maxFileLoadSize) {
    move_uploaded_file($tmp_name, $uploadPath . $fileName);
    $fileFullName = '/img/products/' . $fileName;
    $response['status'] = 'ok';
    
  } elseif (in_array($mime, $fileTypes) && $size > $maxFileLoadSize) {
    $response['error'] = 'Превышен допустимый размер файла!_____ ' . $fileName;
    die(json_encode($response));
  } else {
    $response['error'] = 'допускаются только файлы с расширением .jpeg, .jpg, .png!________ ' . $fileName;
    die(json_encode($response));
  }
  
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
  $response['product_name'] = addNewProduct($connect, $product_name, $product_price, $product_photo, $new, $sale, $product_sections);
  die(json_encode($response));
}

// изменение товара
if(isset($_POST['change']) && $_POST['change'] === 'product') {
  $ID = $_POST['id'];
  $product_name = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-name']));
  $product_price = mysqli_real_escape_string($connect, htmlspecialchars($_POST['product-price']));
  $response["status"] = "bad";
  

  if(isset($_FILES ["product-photo"]['name']) && $_FILES ["product-photo"]['name'] !== '') {
    $product_photo = $_FILES ["product-photo"]['name'];
    $photo = [];
    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/img/products/';
    $fileTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    $maxFileLoadSize = 5000000;
    $tmp_name = $_FILES['product-photo']['tmp_name'];
    $mime = mime_content_type($_FILES['product-photo']['tmp_name']);
    $fileName = $_FILES['product-photo']['name'];
    // проверка файла изображение
    if (in_array($mime, $fileTypes) && $size <= $maxFileLoadSize) {
      move_uploaded_file($tmp_name, $uploadPath . $fileName);
      $fileFullName = '/img/products/' . $fileName;
      $response['status'] = 'ok';
    } elseif (in_array($mime, $fileTypes) && $size > $maxFileLoadSize) {
      $response['error'] = 'Превышен допустимый размер файла!_____ ' . $fileName;
      die(json_encode($response));
    } else {
      $response['error'] = 'допускаются только файлы с расширением .jpeg, .jpg, .png!';
      die(json_encode($response));
    }
  } else {
    $product_photo = getImage($connect, $ID);
    $response['status'] = 'ok';
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
  
  $response["product_name"] = editeProduct($connect, $ID, $product_name, $product_price, $product_photo, $new, $sale, $product_sections);
  // $response["product_name"] = $product_name;
  die(json_encode($response));
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
  $status = "Не выполнено";
  $comments = mysqli_real_escape_string($connect, clean($_POST['comment'])) ?? '';
  $city = mysqli_real_escape_string($connect, clean($_POST['city'])) ?? '';
  $street = mysqli_real_escape_string($connect, clean($_POST['street'])) ?? '';
  $home = mysqli_real_escape_string($connect, clean($_POST['home'])) ?? '';
  $aprt = mysqli_real_escape_string($connect, clean($_POST['aprt'])) ?? '';
  $productId = $_POST['prod-id'];
  $productPrice = getProdPrice($connect, $productId);
  
  if(!check_length($phone, 7, 12) || $phone === '') {
    $result['status'] = 'Допущена ошибка в номере телефона';
    die(json_encode($result));
  }
  if(!check_length($email, 5, 100) || $email === '') {
    $result['status'] = 'Допущена ошибка в email';
    die(json_encode($result));
  }
  if(!check_length($name, 2, 50) || $name === '') {
    $result['status'] = 'Допущена ошибка в написании имени';
    die(json_encode($result));
  }
  if(!check_length($surname, 2, 50)) {
    $result['status'] = 'Допущена ошибка в написании фамилии';
    die(json_encode($result));
  }
  if($productPrice <= $minsum && $delivery === 'Курьерная доставка') {
    $productPrice += $deliveryPrice;
  }
  
  $result['status'] = addNewOrder($connect, $date, $productPrice, $name, $surname, $thirdname, $email, $phone, $delivery, $payment, $status, $comments, $city, $street, $home, $aprt, $productId);
  
  $result['productPrice'] = $productPrice;
  die(json_encode($result));
}