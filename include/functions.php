<?php

$connect = mysqli_connect($host, $user, $password, $bdname);

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
// createUser($connect, 'admin', 'admin@fashion.ru', 'admin');
// createUser($connect, 'operator1', 'operator1@fashion.ru', 'o1p2e3r4');

function getAllProducts($connect) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        return mysqli_query($connect, "SELECT * from products ");
        // showProducts($connect, $products);
    }
}
function showProducts($products) {
    while($row = mysqli_fetch_assoc($products)) { 
        $img = $row['img'];
        $name = $row['name'];
        $price = $row['price']; 
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
<?php } 
}
function sortProducts($a, $b) {
    return $a['sort'] > $b['sort'];
}
function sortByPrice($products) {
    usort($products, sortProducts($price));  
}
function getNewProducts($connect) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        $products = mysqli_query($connect, "SELECT * from products where new=1");
        showProducts($products);
    }
}
function getSaleProducts($connect) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        $products = mysqli_query($connect, "SELECT * from products where sale=1");
        showProducts($products);
    }
}
function getNewSaleProducts($connect) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        $products = mysqli_query($connect, "SELECT * from products where sale='1' or new=1");
        showProducts($connect, $products);
    }
}
function showProductsAdm($products) {
    while($row = mysqli_fetch_assoc($products)) { 
        $ID = $row['id'];
        $img = $row['img'];
        $name = $row['name'];
        $price = $row['price']; 
        $section = $row['section'];
        $new = $row['new'];
        ?>
    <li class="product-item page-products__item">
      <b class="product-item__name"><?=$name?></b>
      <span class="product-item__field"><?=$ID?></span>
      <span class="product-item__field"><?=$price?></span>
      <span class="product-item__field"><?=$section?></span>
      <span class="product-item__field"><?=$new?></span>
      <a href="/php_diplom/products/add.php" class="product-item__edit" aria-label="Редактировать"></a>
      <button class="product-item__delete"></button>
    </li>
<?php } 
}


// admin

function getSectionName($connect) {
    $result = mysqli_query($connect, "SELECT * from sections");
    while($row = mysqli_fetch_assoc($result)) { ?>
        <option value="<?=$row['name']?>"><?=$row['name']?></option>
    <?php }
}

function addNewProduct($connect, $product_name, $product_price, $product_photo, $product_section, $new, $sale) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        mysqli_query($connect, "INSERT into fashion.products (name, price, activity, img, section, new, sale)
        values ($product_name, $product_price, 1, $product_photo, $product_section, $new, $sale)");
    }
  }
