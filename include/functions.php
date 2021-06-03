<?php

$connect = mysqli_connect($host, $user, $password, $bdname);
$counter = 0;
// создать пользователя (без вывода на сайте)
function createUser($connect, $name, $login, $password) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        mysqli_query($connect, "INSERT into users (name, login, password)
        values ('".mysqli_real_escape_string($connect, $name)."', 
        '".mysqli_real_escape_string($connect, $login)."', 
        '".mysqli_real_escape_string($connect, $password)."')");
    }
}
// createUser($connect, 'admin', 'admin@fashion.ru', 'admin';
// createUser($connect, 'operator1', 'operator1@fashion.ru', 'o1p2e3r4');



// получить из БД все продукты 
function getAllProducts($connect, $num, $start) {
   

    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        return mysqli_query($connect, "SELECT * from products LIMIT $num OFFSET $start");
    }
}

// получение всех новинок или распродаж
function getSaleNewProducts($connect, $filter, $num, $start) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        $req = "SELECT * from products where ".$filter." LIMIT $num OFFSET $start";
        return mysqli_query($connect, $req);
    }
}
// получение распродаж и новинок 
function getNewSaleProducts($connect) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        return mysqli_query($connect, "SELECT * from products where sale=1 and new=1");  
    }
}

// вывод продуктов на главной странице
function showProducts($products) {

    while($row = mysqli_fetch_assoc($products)) { 
        $img = $row['img'];
        $name = $row['name'];
        $price = $row['price']; 
        // getCounter($counter);
        ?>
    <article class="shop__item product" tabindex="0">
        <div class="product__image">
        <img src="./img/products/<?=$img?>" alt="product-name">
        </div>
        <p class="product__name"><?=$name?></p>
        <span class="product__price"><?=$price?> руб.</span>
        <span class="product__new"><?= $row['new'] == 1 ? 'new' : ''?></span>
        <span class="product__sale"><?= $row['sale'] == 1 ? 'sale' : ''?></span>
    </article>
<?php 
    } 
    // return $counter;
}


// получение названия категории
function getSection($connect, $section){
    $section_names = mysqli_query($connect, "SELECT name from sections where id='$section' LIMIT 1");
        while($row = mysqli_fetch_assoc($section_names)) {
            return $row['name'];
        }
}

// администратор

// вывод списка продуктов во вкладке администратора
function showProductsAdm($connect, $products) {
    while($row = mysqli_fetch_assoc($products)) { 
        $ID = $row['id'];
        $img = $row['img'];
        $name = $row['name'];
        $price = $row['price']; 
        $section = $row['category_id'];
        $new = $row['new'];
        if($new==1){
            $new='Да';
        } else {
            $new='Нет';
        }
    ?>
    <li class="product-item page-products__item">
      <b class="product-item__name"><?=$name?></b>
      <span class="product-item__field"><?=$ID?></span>
      <span class="product-item__field"><?=$price?></span>
      <span class="product-item__field"><?=getSection($connect, $section); ?></span>
      <span class="product-item__field"><?=$new?></span>
      <a href="/php_diplom/products/add.php" class="product-item__edit" aria-label="Редактировать"></a>
      <button class="product-item__delete"></button>
    </li>
<?php } 
}

// получение и вывод списка категорий во вкладке создание продукта
function getSectionName($connect) {
    $result = mysqli_query($connect, "SELECT * from sections");
    while($row = mysqli_fetch_assoc($result)) { ?>
        <option value="<?=$row['id']?>"><?=$row['name']?></option>
    <?php }
}
// создать новый продукт во вкладке администратора /products/add.php
// function createProduct($connect, $name, $price, $img, $new, $sale, $category) {
//     $password = password_hash($password, PASSWORD_DEFAULT);
//     if (mysqli_connect_errno()) {
//         $err = "Ошибка ".mysqli_connect_error();
//         exit();
//     } else {
//         mysqli_query($connect, "INSERT into users (name, price, activity, img, new, sale, category_id)
//         values ('$name', '$price', 1, '$img', '$new', '$sale', '$category')");
//     }
// }
// добавление нового продукта в БД во вкладке администратора /products/form.php
function addNewProduct($connect, $name, $price, $photo, $section, $new, $sale) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        echo json_encode($err);
        exit();
    } else {
        mysqli_query($connect, "INSERT into products (name, price, activity, img, new, sale, category_id)
        values ('$name', '$price', '1', '$photo', '$new', '$sale', '$section')");
        echo json_encode($name);
    }
  }


// фильтрация товаров
function getFilterCategoryProducts($connect, $param="SELECT * from products ") {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        return mysqli_query($connect, $param);
    }
    mysqli_close($connect);
    exit();
}


function isCurrentUrl($url){
    return $url == $_SERVER['REQUEST_URI'];
}

function getCounter($connect, $param = 'SELECT COUNT(*) FROM products '){
    $res = mysqli_query($connect, $param);
    $row = mysqli_fetch_assoc($res);
    $counter = $row["COUNT(*)"];
    return $counter;
}

function build_http_query( $query ){

    $query_array = [];
    foreach( $query as $key => $value ){
        $query_array[] = urlencode( $key ) . '=' . urlencode( $value );
    }
    return implode( ' ', $query_array );
}
function getRequest($data, $num, $start, $reqStart = "SELECT * from products "){
    if(($data['page'])){
        $start = ($data['page'] * $num) - $num;
    } else {
        $start = 0;
    }
    
    $req = $reqStart;
   
    if(isset($data['category'])){  
        $req .= 'where '; 
        
        $category = $data['category']?? 0;
        $min = $data['min']?? 0;
        $max = $data['max']?? 100000;
        $saleP = $data['sale']?? 0;
        $newP = $data['new']?? 0;
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
    
    
    if($data['sort']){
        if($data['sort'] == 'sortByName' && $data['order'] == 'on'){
            $req .= " ORDER BY name ASC ";
        } elseif($data['sort'] == 'sortByName' && $data['order'] == 'reverse'){
            $req .= " ORDER BY name DESC ";
        } elseif($data['sort'] == 'sortByPrice' && $data['order'] == 'on'){
            $req .= " ORDER BY price ASC ";
        } else{
            $req .= " ORDER BY price DESC ";
        }
    }
    if($reqStart !== "SELECT COUNT(*) from products "){
        if($start > 0){
            $req .= " LIMIT $num OFFSET $start";
        } else {
            $req .= " LIMIT $num";
        }
    }
    
    
    return $req;
}



// function getCategoryRequest($data, $category, $regS, $start){
//     $start = ($data['page'] * $num) - $num;
//     $req = $regS;   
    
//     if(isset($data['category'])){  
//         $req .= 'where ';
//         $category = $data['category']?? 0;
//         $min = $data['min']?? 0;
//         $max = $data['max']?? 100000;
//         $saleP = $data['sale']?? 0;
//         $newP = $data['new']?? 0;
//         if($category>0){
//             $req .= 'category_id='.$category . " and ";
//         } 
        
//         if($saleP>0){
//             $req .= 'sale='.$saleP." and ";
//         }

//         if($newP>0){
//             $req .= 'new='.$newP. " and ";
//         }    
//         $req .= ' price between '.$min.' and '.$max;        
//     }  
    
    
//     if(isset($data['sort'])){
//         if($data['sort'] == 'sortByName' && $data['order'] == 'on'){
//             $req .= " ORDER BY name ASC ";
//         } elseif($data['sort'] == 'sortByName' && $data['order'] == 'reverse'){
//             $req .= " ORDER BY name DESC ";
//         } elseif($data['sort'] == 'sortByPrice' && $data['order'] == 'on'){
//             $req .= " ORDER BY price ASC ";
//         } else{
//             $req .= " ORDER BY price DESC ";
//         }
//     }
//     if($start > 0){
//         $req .= " LIMIT $num OFFSET $start";
//     } else {
//         $req .= " LIMIT $num";
//     }
//     echo $req;
//     // return $req;
// }