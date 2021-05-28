<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom//include/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom//include/functions.php';

// фильтрация товаров
function getFilterCategoryProducts($connect, $param) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        $products = mysqli_query($connect, $param);
        showProducts($products);
    }
    mysqli_close($connect);
    exit();
}
if(isset($_GET)){
    $req = "SELECT * from products ";
    if(isset($_GET['category'])){  
        $req .= 'where ';  
        $category = $_GET['category']?? 0;
        $min = $_GET['min']?? 0;
        $max = $_GET['max']?? 100000;
        $saleP = $_GET['sale'];
        $newP = $_GET['new'];
        if($category>0){
            $req .= 'category_id='.$category . " and ";
        } 
        
        if($saleP>0){
            $req .= 'sale='.$saleP." and ";
        }

        if($newP>0){
            $req .= 'new='.$newP. " and ";
        }    
        $req .= ' price between '.$min.' and '.$max;
        
    }  
    
    
    if(isset($_GET['sort'])){
        if($_GET['sort'] == 'sortByName' && $_GET['order'] == 'on'){
            $req .= " ORDER BY name ASC ";
        } elseif($_GET['sort'] == 'sortByName' && $_GET['order'] == 'reverse'){
            $req .= " ORDER BY name DESC ";
        } elseif($_GET['sort'] == 'sortByPrice' && $_GET['order'] == 'on'){
            $req .= " ORDER BY price ASC ";
        } else{
            $req .= " ORDER BY price DESC ";
        }
    }
    
    // echo $req;
    getFilterCategoryProducts($connect, $req);
    exit();
}

