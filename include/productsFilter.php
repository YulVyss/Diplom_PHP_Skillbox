<?php 
// if(!empty($_GET)) {
//     switch($i) {
//         case $_GET['new']:
//             getNewProducts($connect);
//             break;
//         case $_GET['sale']:
//             getSaleProducts($connect);
//             break;
//         default:
//             getNewSaleProducts($connect);  
//     }
// } else {
//     getAllProducts($connect);
// }

if(!empty($_GET)) {
    if($_GET['new'] == 'on' && $_GET['sale'] == '') {
        getNewProducts($connect);
    } elseif($_GET['sale'] == 'on' && $_GET['new'] == '') {
        getSaleProducts($connect);
    } else{
        getNewSaleProducts($connect); 
    } 
} else {
    $products = getAllProducts($connect);
    showProducts($products);
}

if (isset($_GET['category'])) {
    echo $_GET;
    sortByPrice($products);
}