<?php 
// проверка логина и пароля
if(!isset($_COOKIE['authorized'])) {
  header('Location: /index.php');
} 

include $_SERVER['DOCUMENT_ROOT'] . '/template/header_adm.php'; 

if (mysqli_connect_errno()) {
  $err = "Ошибка ".mysqli_connect_error();
  exit();
} else {
  $query = mysqli_query($connect,"SELECT * FROM users WHERE login ='".mysqli_real_escape_string($connect, $_COOKIE['authorized'])."' LIMIT 1");
  $data = mysqli_fetch_assoc($query);
}  
if($data['rights'] !== 'admin') {
  echo '<h1>У вас нет прав доступа</h1>';
  exit();
} 

$counter = getCounter($connect, 'SELECT COUNT(*) FROM products ');
$productsOnPage = 10;

if(isset($_GET['page']) && $_GET['page'] !== ''){
  $start = ($_GET['page'] * $productsOnPage) - $productsOnPage;
  $req = getRequestMain($_GET, $productsOnPage, $start, "SELECT * from products ORDER BY id DESC ");  
  $count = getRequestMain($_GET, $productsOnPage, $start, "SELECT COUNT(*) from products ");
  $counter = getCounter($connect, $count);
  $products = getFilterCategoryProducts($connect, $req);    
} else {
  $start = 0;
  $counter = getCounter($connect, 'SELECT COUNT(*) FROM products ');
  $products = getAllProducts($connect, $productsOnPage, $start, 'ORDER BY id DESC');
}

$str_pag = ceil($counter / $productsOnPage);
$re = $_SERVER['REQUEST_URI'];

if(isset($_POST['id']) && $_POST['id']) {
  removeProduct($connect, $_POST['id']);
}
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
    if(isset($products)){          
      showProductsAdm($connect, $products);
    }   
    ?>
  </ul>
  <section>
  <ul class="shop__paginator paginator paginator_adm">
        <?php        
          for ($i = 1; $i <= $str_pag; $i++){
            if(isset($_REQUEST['page']) && $_REQUEST['page'] == $i){
              $active = 'active';
            } elseif($re == '/products/index.php' && $i == 1){
              $active = 'active';
            }else{
              $active = '';
            }   
            $_GET['page'] = $i;          
            $req = build_http_query($_GET);            
            echo "<li><a class='paginator__item paginator__item_adm ".$active." ' href='/products/index.php?".$req."' >".$i."</a></li>";
          }           
        ?>
      </ul>
  </section>  
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';