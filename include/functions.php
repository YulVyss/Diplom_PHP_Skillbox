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

// получение из БД всех продуктов 
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
        $id = $row['id'];
        ?>
        <article class="shop__item product" tabindex="0">
            <div class="product__image">
            <img src="./img/products/<?=$img?>" alt="product-name">
            </div>
            <p class="product__name"><?=$name?></p>
            <span class="id" hidden><?=$id?></span>
            <span class="product__price"><?=$price?> руб.</span>
            <span class="product__new"><?= $row['new'] == 1 ? 'new' : ''?></span>
            <span class="product__sale"><?= $row['sale'] == 1 ? 'sale' : ''?></span>
        </article>
        <?php 
    } 
}


// получение названия категории
function getSection($connect, $section){
    $section_names = mysqli_query($connect, "SELECT name from sections where id='$section' LIMIT 1");
        while($row = mysqli_fetch_assoc($section_names)) {
            return $row['name'];
        }
}

// Раздел администратора
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
            <span class="product-item__field product-id"><?=$ID?></span>
            <span class="product-item__field product-price"><?=$price?></span>
            <span class="product-item__field product-category"><?=getSection($connect, $section); ?></span>
            <span class="product-item__field product-new"><?=$new?></span>
            <a href="/products/productChange.php" class="product-item__edit" aria-label="Редактировать"></a>
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
function createProduct($connect, $name, $price, $img, $new, $sale, $category) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        mysqli_query($connect, "INSERT into products (name, price, activity, img, new, sale, category_id)
        values ('$name', '$price', 1, '$img', '$new', '$sale', '$category')");
    }
}

// изменить продукт во вкладке администратора /products/productChange.php
function editeProduct($connect, $name, $price, $img, $new, $sale, $category) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        mysqli_query($connect, "UPDATE products SET name='$name' price='$price' img='$img' new='$new' sale='$sale' category_id='$category' where id='$id' ");
    }
}

// удалить продукт во вкладке администратора /products/index.php
function removeProduct($connect, $productID) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        mysqli_query($connect, "DELETE from products where id='$productID' ");
    }
}

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

// проеврка текущего url
function isCurrentUrl($url){
    return $url == $_SERVER['REQUEST_URI'];
}

// подсчет количества товаров, соответсвующих параметрам
function getCounter($connect, $param = 'SELECT COUNT(*) FROM products '){
    $res = mysqli_query($connect, $param);
    $row = mysqli_fetch_assoc($res);
    $counter = $row["COUNT(*)"];
    return $counter;
}

// получение строки запроса из массива данных
function build_http_query( $query ){
    $query_array = [];
    foreach( $query as $key => $value ){
        $query_array[] = urlencode( $key ) . '=' . urlencode( $value );
    }
    return implode( '&', $query_array );
}

// построение запроса в БД исходя из полученных данных
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

// получение и вывод списка категорий товаров в aside
function getSectionList($connect) {
    $result = mysqli_query($connect, "SELECT * from sections");
    while($row = mysqli_fetch_assoc($result)) { 
      if($_GET['category'] == $row['id']){
        $active = 'active';
      } else{
        $active = 'AAA';
      }
      ?>
      <li>
        <a class="filter__list-item <?=$active?>" href="/?category=<?=$row['id']?>" name="<?=$row['id']?>"><?=$row['name']?></a>
      </li>
        <?php }  
}

// добавление нового продукта в БД во вкладке администратора /products/form.php
function addNewOrder($connect, $date, $productPrice, $name, $surname, $thirdname, $email, $phone, $delivery, $payment, $status, $comments, $city, $street, $home, $aprt, $productId) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        echo json_encode($err);
        exit();
    } else {
        mysqli_query($connect, "INSERT into orders (`date`, `price`, `user-name`, `user-surname`, `user-thirdname`, `email`, `phone`, `delivery`, `payment`, `status`, `comments`, `city`, `street`, `home`, `aprt`, `product-id`)
        values ('$date', '$productPrice', '$name', '$surname', '$thirdname', '$email', '$phone', '$delivery', '$payment', '$status', '$comments', '$city', '$street', '$home', '$aprt', '$productId')");
        echo json_encode($name);
        exit();
    }
  }

  // получение из БД списка заказов 
function getOrders($connect) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        return mysqli_query($connect, "SELECT * from orders ORDER BY status DESC, date ASC");
    }
}

// Вывод всех заказов
  function showOrders($connect, $orders) {
    while($row = mysqli_fetch_assoc($orders)) { 
        $id = $row['id'];
        $name = $row['user-name'];
        $phone = $row['phone'];
        $delivery = $row['delivery']; 
        $payment = $row['payment'];
        $comments = $row['comments'];
        $city = $row['city'];
        $street = $row['street'];
        $home = $row['home'];
        $aprt = $row['aprt'];
        $status = $row['status'];
        $prodPrice = $row['price'];  
    ?>
    <li class="order-item page-order__item">
      <div class="order-item__wrapper">
        <div class="order-item__group order-item__group--id">
          <span class="order-item__title">Номер заказа</span>
          <span class="order-item__info order-item__info--id"><?=$id?></span>
        </div>
        <div class="order-item__group">
          <span class="order-item__title">Сумма заказа</span>
          <?=$prodPrice?>
        </div>
        <button class="order-item__toggle"></button>
      </div>
      <div class="order-item__wrapper">
        <div class="order-item__group order-item__group--margin">
          <span class="order-item__title">Заказчик</span>
          <span class="order-item__info"><?=$name?></span>
        </div>
        <div class="order-item__group">
          <span class="order-item__title">Номер телефона</span>
          <span class="order-item__info"><?=$phone?></span>
        </div>
        <div class="order-item__group">
          <span class="order-item__title">Способ доставки</span>
          <span class="order-item__info"><?=$delivery?></span>
        </div>
        <div class="order-item__group">
          <span class="order-item__title">Способ оплаты</span>
          <span class="order-item__info"><?=$payment?></span>
        </div>
        <div class="order-item__group order-item__group--status">
          <span class="order-item__title">Статус заказа</span>
          <?php 
          if($status == 'Выполнено') { ?>
            <span class="order-item__info order-item__info--yes"><?=$status?></span>
          <?php } else { ?>
              <span class="order-item__info order-item__info--no"><?=$status?></span>
          <?php } ?>          
          <button class="order-item__btn">Изменить</button>
        </div>
      </div>
      <div class="order-item__wrapper">
        <div class="order-item__group">
          <span class="order-item__title">Адрес доставки</span>
          <span class="order-item__info">г. <?=$city?>, ул. <?=$street?>, д.<?=$home?>, кв. <?=$aprt?></span>
        </div>
      </div>
      <div class="order-item__wrapper">
        <div class="order-item__group">
          <span class="order-item__title">Комментарий к заказу</span>
          <span class="order-item__info"><?=$comments?></span>
        </div>
      </div>
    </li>
    <?php
    }
  }

// получить цену за товар по номеру id
  function getProdPrice($connect, $id) {
    $result = mysqli_query($connect, "SELECT price from products where id=$id");
    while($row = mysqli_fetch_assoc($result)) {
        return $row['price'];
    }
}

