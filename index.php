<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/aside.php'; ?>
<?php

$req = " LIMIT $num";


if(($_GET['page'])){
  $start = ($_GET['page'] * $num) - $num;
  $req = getRequest($_GET, $num, $start, "SELECT * from products ");
  
    $count = getRequest($_GET, $num, $start, "SELECT COUNT(*) from products ");
    echo $count; 
    $counter = getCounter($connect, $count);
    echo "counter: " . $counter;
    $products = getFilterCategoryProducts($connect, $req);
    
    
} else {
  $start = 0;
  $counter = getCounter($connect, 'SELECT COUNT(*) FROM products ');
  $products = getAllProducts($connect, $num, $start);
}
$str_pag = ceil($counter / $num);

?>
      <p class="shop__sorting-res">Найдено <span class="res-sort"><?=$counter;?></span> моделей</p>
    </section>
    <section class="shop__list">
      <?php 
        if($products){          
          showProducts($products);
        }         
      ?>
    </section>
      <ul class="shop__paginator paginator">
      <?php
        for ($i = 1; $i <= $str_pag; $i++){     
          $active = isCurrentUrl('/php_diplom/?page='.$i) ? 'active' : '';
          echo "<li><a class='paginator__item ".$active." ' href=?page=".$i.">".$i." </a></li>";
        }
      ?>
      </ul>
    </div>
  </section>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/order.php'; ?>
</main>
</html>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/footer.php'; ?>
