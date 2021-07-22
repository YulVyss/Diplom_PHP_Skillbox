<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/include/session.start.php';
include $_SERVER['DOCUMENT_ROOT'] . '/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/functions.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Fashion</title>
  <meta name="description" content="Fashion - интернет-магазин">
  <meta name="keywords" content="Fashion, интернет-магазин, одежда, аксессуары">
  <meta name="theme-color" content="#393939">
  <link rel="preload" href="./img/intro/coats-2018.jpg" as="image">
  <link rel="preload" href="./fonts/opensans-400-normal.woff2" as="font">
  <link rel="preload" href="./fonts/roboto-400-normal.woff2" as="font">
  <link rel="preload" href="./fonts/roboto-700-normal.woff2" as="font">
  <link rel="icon" href="./img/favicon.png">
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="./js/scripts.js" defer=""></script>
  <script src="./js/custom.js" defer=""></script>
</head>
<body>
<header class="page-header">
  <a class="page-header__logo" href="/">
    <img src="./img/logo.svg" alt="Fashion">
  </a>
  <nav class="page-header__menu">
    <ul class="main-menu main-menu--header">
      <li>
        <a class="main-menu__item active" href="/">Главная</a>
      </li>
      <li>
        <a class="main-menu__item" href="/new.php">Новинки </a>
      </li>
      <li>
        <a class="main-menu__item" href="/sale.php">Sale</a>
      </li>
      <li>
        <a class="main-menu__item" href="/delivery.php">Доставка</a>
      </li>
    </ul>
  </nav>
  <a href="/admin/index.php" class="authorization main-menu__item">Войти</a>
</header>

  <main class="page-delivery">
    <h1 class="h h--1">Доставка</h1>
    <p class="page-delivery__desc">
      Способы доставки могут изменяться в зависимости от адреса доставки, времени осуществления покупки и наличия
      товаров.
    </p>
    <p class="page-delivery__desc page-delivery__desc--strong">
      <b>При оформлении покупки мы проинформируем вас о доступных способах доставки, стоимости и дате доставки вашего
        заказа.</b>
    </p>
    <section class="page-delivery__info">
      <header class="page-delivery__desc">
        Возможные варианты доставки:
        <b class="page-delivery__variant">Доставка на дом:</b>
      </header>
      <ul class="page-delivery__list">
        <li>
          <b class="page-delivery__item-title">Стандартная доставка - <?=$deliveryPrice?> РУБ / БЕСПЛАТНО (ДЛЯ ЗАКАЗОВ ОТ <?=$minsum?> РУБ)</b>
          <p class="page-delivery__item-desc">
            Примерный срок доставки составит около 2-7 рабочих дней, в зависимости от адреса доставки.
          </p>
        </li>
        <li>
          <b class="page-delivery__item-title">В день покупки - 560 РУБ</b>
          <p class="page-delivery__item-desc">
            Доступна для жителей г. Москва в пределах МКАД. Заказы, оформленныес понедельника по пятницу до 14:00 будут
            доставлены в тот же день с 19:00до 23:00. Изменение адреса доставки после оформления заказа невозможно.
          </p>
        </li>
        <li>
          <b class="page-delivery__item-title">Доставка с примеркой перед покупкой по Москве - <?=$deliveryPrice?> РУБ / БЕСПЛАТНО (ПРИ
            ВЫКУПЕ НА СУММУ ОТ <?=$minsum?> РУБ)</b>
          <p class="page-delivery__item-desc">
            Доставка возможна только по Москве (в пределах МКАД) в течение 2-3 дней.
            Воспользовавшись услугой «Примерка перед покупкой», вы можете получить свой заказ и примерить заказанные
            товары. Вы оплачиваете только то, что вам подошло. Максимальное количество позиций в заказе, при котором
            доступна примерка, составляет 10 вещей. Время на примерку одного заказа – 15 минут.
          </p>
        </li>
      </ul>
      <p class="page-delivery__desc">
        Мы свяжемся с вами, чтобы подтвердить дату и время доставки. Кроме того, вы будете получать уведомления по
        электронной почте и SMS с информацией о номере заказа, его стоимости, а также с информацией о том, что заказ
        готов к выдаче. В день доставки заказа мы отправим вам SMS-уведомлениес номером телефона сотрудника службы
        доставки.
      </p>
      <a class="page-delivery__button button" href="index.php">Продолжить покупки</a>
    </section>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'; ?>