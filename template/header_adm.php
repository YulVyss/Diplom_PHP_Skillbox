<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/include/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/include/functions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/include/login.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Добавление товара</title>

  <meta name="description" content="Fashion - интернет-магазин">
  <meta name="keywords" content="Fashion, интернет-магазин, одежда, аксессуары">

  <meta name="theme-color" content="#393939">

  <link rel="preload" href="../fonts/opensans-400-normal.woff2" as="font">
  <link rel="preload" href="../fonts/roboto-400-normal.woff2" as="font">
  <link rel="preload" href="../fonts/roboto-700-normal.woff2" as="font">

  <link rel="icon" href="../img/favicon.png">
  <link rel="stylesheet" href="../css/style.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="../js/scripts.js" defer=""></script>
  <script src="../js/custom.js" defer=""></script>
</head>
<body>
<header class="page-header">
  <a class="page-header__logo" href="#">
    <img src="/php_diplom/img/logo.svg" alt="Fashion">
  </a>
  <nav class="page-header__menu">
    <ul class="main-menu main-menu--header">
      <li>
        <a class="main-menu__item" href="/php_diplom/">Главная</a>
      </li>
      <li>
        <a class="main-menu__item" href="/php_diplom/products/">Товары</a>
      </li>
      <li>
        <a class="main-menu__item" href="/php_diplom/products/orders.php">Заказы</a>
      </li>
      <li>
        <a class="main-menu__item" href="?logout=on">Выйти</a>
      </li>
    </ul>
  </nav>
</header>