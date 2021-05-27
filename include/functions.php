<?php

$connect = mysqli_connect($host, $user, $password, $bdname);
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
function getAllProducts($connect) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        return mysqli_query($connect, "SELECT * from products ");
    }
}
// получить из БД продукты сортированные по 
function getSortedProducts($connect, $sort) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        return mysqli_query($connect, "SELECT * from products  ORDER BY $sort");
    }
}


// сортировка всех продуктов на главной странице

function sortProducts($a, $b) {
    return $a['sort'] > $b['sort'];
}
function sortByPrice($products) {
    usort($products, sortProducts($price));  
}

// получение всех новинок или распродаж
function getNewProducts($connect, $filter) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        return mysqli_query($connect, "SELECT * from products where $filter=1");
        // showProducts($products);
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
// // фильтрация товаров по категориям
// function getFilterCategoryProducts($connect, $category) {
//     if (mysqli_connect_errno()) {
//         $err = "Ошибка ".mysqli_connect_error();
//         exit();
//     } else {
//         $products = mysqli_query($connect, "SELECT * from products where category_id=$category");
//         showProducts($products);
//     }
//     mysqli_close($connect);
// }
// вывод продуктов на главной странице
function showProducts($products) {
    while($row = mysqli_fetch_assoc($products)) { 
        $img = $row['img'];
        $name = $row['name'];
        $price = $row['price']; 
        getCounter($counter);
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
// получение названия категории
function getSection($connect, $section){
    $section_names = mysqli_query($connect, "SELECT name from sections where id='$section' LIMIT 1");
        while($row = mysqli_fetch_assoc($section_names)) {
            return $row['name'];
        }
}

function getCounter($counter){
    return $counter++;
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


