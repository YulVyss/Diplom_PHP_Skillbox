<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/aside.php'; ?>
<?php
$str_pag = ceil($counter / $num);
?>
      
        <p class="shop__sorting-res">Найдено <span class="res-sort"><?=$counter;?></span> моделей</p>
      </section>
      <section class="shop__list">
      <?php 
        $products = getSaleNewProducts($connect, 'new=1', $num, $start);
        showProducts($products);
      
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
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/footer.php'; ?> -->
