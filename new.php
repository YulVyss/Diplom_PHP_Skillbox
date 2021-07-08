<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/template/header.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/template/aside.php';
$re = $_SERVER['REQUEST_URI'];
$counter = getCounter($connect, 'SELECT COUNT(*) FROM products where new=1 ');

if(isset($_GET['page']) && ($_GET['page'])){
  $start = ($_GET['page'] * $num) - $num;
  $req = getRequest($_GET, $num, $start, "SELECT * from products ");    
  $count = getRequest($_GET, $num, $start, "SELECT COUNT(*) from products ");
  $counter = getCounter($connect, $count);
  $products = getFilterCategoryProducts($connect, $req);    
} else {
  $start = 0;
  $counter = getCounter($connect, 'SELECT COUNT(*) FROM products where new=1 ');
  $products = getSaleNewProducts($connect, 'new=1', $num, $start);
}
$str_pag = ceil($counter / $num);
?>      
        <p class="shop__sorting-res">Найдено <span class="res-sort"><?=$counter;?></span> моделей</p>
      </section>
      <section class="shop__list">
      <?php 
        if(isset($products)){          
          showProducts($products);
        }
      ?>
      </section>
      <ul class="shop__paginator paginator">
        <?php        
          for ($i = 1; $i <= $str_pag; $i++) {
            if(isset($_REQUEST['page']) && $_REQUEST['page'] == $i){
              $active = 'active';
            } elseif($re == '/new.php' && $i == 1){
              $active = 'active';
            }else{
              $active = '';
            }   
            $_GET['page'] = $i;
            $_GET['new'] = 1;          
            $req = build_http_query($_GET);            
            echo "<li><a class='paginator__item ".$active." ' href='/new.php?".$req."' >".$i."</a></li>";
          }           
        ?>
      </ul>
    </div>
  </section>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/template/order.php'; ?>
</main>
</html>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'; ?> -->
