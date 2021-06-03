<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom//include/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom//include/functions.php';

// фильтрация товаров
// var_dump($_GET);
if(isset($_GET)){   
    $req = getRequest($_GET, $num, $start, "SELECT * from products ");
    
    $count = getRequest($_GET, $num, $start, "SELECT COUNT(*) from products ");
    
    $counter = getCounter($connect, $count);
    
    $products = getFilterCategoryProducts($connect, $req);
    showProducts($products);
    
    echo '<p hidden class="counter">'.$counter.'</p>';
    
    exit();
}

