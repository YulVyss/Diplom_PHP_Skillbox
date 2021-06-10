<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/header_adm.php'; 

?>
<main class="page-products">
  <h1 class="h h--1">Товары</h1>
  <a class="page-products__button button" href="/products/add.php">Добавить товар</a>
  <div class="page-products__header">
    <span class="page-products__header-field">Название товара</span>
    <span class="page-products__header-field">ID</span>
    <span class="page-products__header-field">Цена</span>
    <span class="page-products__header-field">Категория</span>
    <span class="page-products__header-field">Новинка</span>
  </div>
  <ul class="page-products__list">
    <?php 
    $products = getAllProducts($connect);
    showProductsAdm($connect, $products);  ?>
  </ul>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';