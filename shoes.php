<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/aside.php'; ?>
<?php



$req = "where category_id = 5  LIMIT $num";


$total = getCounter($page, $connect, 'SELECT COUNT(*) FROM products '.$req);

$str_pag = ceil($total / $num);

if($_GET){
  var_dump($_GET);
  $reqS = "SELECT * from products ";
  // $countS = "SELECT COUNT(*) FROM products ";

  $req = getCategoryRequest($_GET, '5', $reqS);
  
}


$products = getFilterCategoryProducts($connect, 'SELECT * from products '.$req);
?>
        <p class="shop__sorting-res">Найдено <span class="res-sort"><?=$total?></span> моделей</p>
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
