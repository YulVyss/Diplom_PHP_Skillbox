<?php 
if(!isset($_COOKIE['authorized'])) {
  header('Location: /index.php');
}
include $_SERVER['DOCUMENT_ROOT'] . '/template/header_adm.php';

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