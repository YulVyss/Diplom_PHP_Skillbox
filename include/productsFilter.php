<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/functions.php';

// фильтрация товаров
if(isset($_GET)){   
    $req = getRequestMain($_GET, $num, $start, "SELECT * from products ");    
    $count = getRequestMain($_GET, $num, $start, "SELECT COUNT(*) from products ");    
    $counter = getCounter($connect, $count);    
    $products = getFilterCategoryProducts($connect, $req); 
    showProducts($products);
    echo '<p hidden class="counter">'.$counter.'</p>';    
    exit();
}
