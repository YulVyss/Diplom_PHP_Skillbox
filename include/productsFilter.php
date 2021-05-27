<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom//include/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom//include/functions.php';
// var_dump($_GET);

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
    $category = $_GET['category']?? 0;
    $min = $_GET['min'];
    $max = $_GET['max'];
    $saleP = $_GET['sale'];
    $newP = $_GET['new'];
    if($category>0){
        $req1 = 'category_id='.$category . " and ";
    } else{
        $req1 = '';
    }
    
    $req2 = 'sale='.$saleP;
    $req3 = 'new='.$newP;
    $req4 = 'price between '.$min.' and '.$max;
    $req = "SELECT * from products where " . $req1 . $req2 . " and ". $req3 . " and " . $req4;
    // echo $req;
    getFilterCategoryProducts($connect, $req);
    
}







// if(!empty($_GET)) {  
//     if($_GET['new'] == 'on' && $_GET['sale'] == 'on') {
//         $products = getNewSaleProducts($conn);
//     }
//     // } elseif($_GET['sale'] == 'on' && $_GET['new'] == '') {
//     //     $products = getNewProducts($connect, 'sale');
//     // } elseif($_GET['sale'] == 'on' && $_GET['new'] == 'on'){
//     //     $products = getNewSaleProducts($connect); 
//     // } elseif(isset($_GET['sortByName'])){
//     //     $products = getSortedProducts($connect, 'name');
//     // } elseif(isset($_GET['sortByPrice'])){
//     //     $products = getSortedProducts($connect, 'price');
//     // }
//     return $products;
//    exit();
// } else {
//     $products = getAllProducts($conn);
//     return $products;
//     exit();
// }

// if (isset($_GET['category'])) {
//     echo $_GET;
//     sortByPrice($products);
// }


