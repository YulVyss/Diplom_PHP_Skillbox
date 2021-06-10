<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/template/header.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/template/aside.php'; 

$str_pag = ceil($counter / $num);
$filter = 'sale=1';
$products = getSaleNewProducts($connect, $filter, $num, $start);
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
          $active = isCurrentUrl('/?page='.$i) ? 'active' : '';
          echo "<li><a class='paginator__item ".$active." ' href=?page=".$i.">".$i." </a></li>";
        }
      ?>
      </ul>
    </div>
  </section>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/template/order.php'; ?>
</main>
</html>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'; ?>
