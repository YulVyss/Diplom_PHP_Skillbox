<?php 
if(!isset($_COOKIE['authorized'])) {
  header('Location: /index.php');
}
include $_SERVER['DOCUMENT_ROOT'] . '/template/header_adm.php';

if(isset($_POST['prod-id']) && $_POST['prod-id'] !== '') {
  if($name == '' || $surname == '' || $email == '' || $phone == ''){
    echo $err = 'ошибка валидации';
    exit();
  }
  $date = date("Y-m-d H:i:s");
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $thirdname = $_POST['thirdname'] ?? '';
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $delivery = $_POST['delivery'];
  $payment = $_POST['payment'];
  $status = 'Не выполнено';
  $comments = $_POST['comment'] ?? '';
  $city = $_POST['city'] ?? '';
  $street = $_POST['street'] ?? '';
  $home = $_POST['home'] ?? '';
  $aprt = $_POST['aprt'] ?? '';
  $productId = $_POST['prod-id'];
  $productPrice = $_POST['prod-price'];
  
  if($productPrice <= $minsum && $delivery === 'Курьерная доставка') {
    $productPrice += $delivery;
  }
  // addNewOrder($connect, $date, $productPrice, $name, $surname, $thirdname, $email, $phone, $delivery, $payment, $status, $comments, $city, $street, $home, $aprt, $productId);
}


?>
<main class="page-order">
  <h1 class="h h--1">Список заказов</h1>
  <ul class="page-order__list">
    <?php 
      $orders = getOrders($connect);
      showOrders($connect, $orders);
    ?>    
  </ul>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';