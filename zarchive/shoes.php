<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/aside.php'; ?>


      <section class="shop__list">
      <?php 
        $products = getFilterCategoryProducts($connect, '5');
        showProducts($products);
      ?>
      </section>
      <ul class="shop__paginator paginator">
        <li>
          <a class="paginator__item">1</a>
        </li>
        <li>
          <a class="paginator__item" href="">2</a>
        </li>
      </ul>
    </div>
  </section>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/order.php'; ?>
</main>
</html>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/footer.php'; ?>
