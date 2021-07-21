<?php
$connect = mysqli_connect($host, $user, $password, $bdname);
$counter = 0;

// создать пользователя (без вывода на сайте)
function createUser($connect, $name, $login, $password, $rights) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        mysqli_query($connect, "INSERT into users (name, login, password, rights)
        values ('".mysqli_real_escape_string($connect, $name)."', 
        '".mysqli_real_escape_string($connect, $login)."', 
        '".mysqli_real_escape_string($connect, $password)."', '$rights')");
    }
}
// createUser($connect, 'admin', 'admin@fashion.ru', 'admin', 'admin';
// createUser($connect, 'operator1', 'operator1@fashion.ru', 'o1p2e3r4', 'operator');
// createUser($connect, 'operator2', 'operator2@fashion.ru', '33p2eh84', 'operator');

// получение из БД всех продуктов 
function getAllProducts($connect, $num, $start, $sort = 'ORDER BY product_id ASC') {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        return mysqli_query($connect, "SELECT * from products $sort LIMIT $num OFFSET $start ");
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

// вывод продуктов на главной странице
function showProducts($products) {
    while($row = mysqli_fetch_assoc($products)) { 
        $img = $row['img'];
        $name = $row['name'];
        $price = $row['price']; 
        $id = $row['product_id'];
        ?>
        <article class="shop__item product" tabindex="0">
            <div class="product__image">
            <img src="./img/products/<?=$img?>" alt="product-image">
            </div>
            <p class="product__name"><?=$name?></p>
            <p><span class="id" ><?=$id?></span></p>
            <span class="product__price"><?=$price?> руб.</span>
            <span class="product__new"><?= $row['new'] == 1 ? 'new' : ''?></span>
            <span class="product__sale"><?= $row['sale'] == 1 ? 'sale' : ''?></span>
        </article>
        <?php 
    } 
}

// получение названия категории
function getSection($connect, $section){
    $section_names = mysqli_query($connect, "SELECT name from sections where id=" . (int)$section . " LIMIT 1");
        while($row = mysqli_fetch_assoc($section_names)) {
            return $row['name'];
        }
}

// Раздел администратора
// вывод списка продуктов во вкладке администратора
function showProductsAdm($connect, $products) {
    while($row = mysqli_fetch_assoc($products)) { 
        $ID = $row['product_id'];
        $img = $row['img'];
        $name = $row['name'];
        $price = $row['price']; 
        $sections = getProdCategory ($connect, $ID);
        $new = $row['new'];
        if($new==1){
            $newText='Да';
        } else {
            $newText='Нет';
        } ?>
        <li class="product-item page-products__item">
            <b class="product-item__name"><?=$name?></b>
            <span class="product-item__field product-id"><?=$ID?></span>
            <span class="product-item__field product-price"><?=$price?></span>
            <span class="product-item__field product-category">
                <?php 
                foreach($sections as $section) {
                    echo getSection($connect, $section);
                    echo '</br>';
                } ?>
            </span>
            <span class="product-item__field product-new"><?=$newText?></span>
            <a href="/products/productChange.php?id=<?=$ID?>" class="product-item__edit" aria-label="Редактировать"></a>
            <button class="product-item__delete"></button>
        </li>
    
    <?php    } 
}

// получение и вывод списка категорий во вкладке создание продукта
function getSectionName($connect, $sectionId = '') {
    $result = mysqli_query($connect, "SELECT * from sections");
    while($row = mysqli_fetch_assoc($result)) { 
        $selected = '';
        if(in_array($row['id'], $sectionId)) {
            $selected = 'selected';
        }
        ?>
        <option value="<?=$row['id']?>" <?=$selected?> ><?=$row['name']?></option>
    <?php }
}

// добавление нового товара в БД во вкладке администратора /products/form.php
function addNewProduct($connect, $name, $price, $photo, $new, $sale, $sections) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        return $err;
    } else {
        mysqli_query($connect, "INSERT into products (name, price, activity, img, new, sale)
        values ('$name', '$price', '1', '$photo', '$new', '$sale')");

        $id_product = getProdID($connect);
        $product_sections = explode(',', $sections);

        foreach($product_sections as $section) {
            mysqli_query($connect, "INSERT into products_sections (id_prod, id_section)
            values ($id_product, $section)");
        }
        return $name;
    }
}
// получить ID последнего добавленного товара
function getProdID ($connect) {
    $result = mysqli_query($connect, "SELECT product_id FROM products ORDER BY product_id DESC LIMIT 1");
    while($row = mysqli_fetch_assoc($result)) { 
        $id_product = $row['product_id'];
    }
    return $id_product;
}

function getProdCategory ($connect, $id_product) {
    $id_section = [];
    $result = mysqli_query($connect, "SELECT id_section from products_sections where id_prod=" . (int)$id_product);
    while($row = mysqli_fetch_assoc($result)) { 
        $id_section[] = $row['id_section'];
    }
    return $id_section;
}

// изменить продукт во вкладке администратора /products/productChange.php
function editeProduct($connect, $id, $name, $price, $img, $new, $sale, $categories) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        return json_encode($err);
    } else {
        $categories_id = explode(',', $categories);
        mysqli_query($connect, "DELETE from products_sections where id_prod=" . (int)$id);
        foreach($categories_id as $category) {
            mysqli_query($connect, "INSERT into products_sections (id_prod, id_section)
                values ('$id', '$category')");
        }        
        mysqli_query($connect, "UPDATE products SET name='$name', price='$price', img='$img', new='$new', sale='$sale' where product_id='$id' ");
        return $name; 
    }
}

// удалить продукт во вкладке администратора /products/index.php
function removeProduct($connect, $productID) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        mysqli_query($connect, "DELETE from products_sections where id_prod=" . (int)$productID);
        mysqli_query($connect, "DELETE from products where product_id=" . (int)$productID);        
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
function isCurrentUrl($req){
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[0];    
    return $url === $req;
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

// построение запроса в БД исходя из полученных данных на главной
function getRequestMain($data, $num, $start, $reqStart = "SELECT * from products "){
    if(isset($data['page']) && $data['page'] !== ''){
        $start = ($data['page'] * $num) - $num;
    } else {
        $start = 0;
    }    
    $req = $reqStart;   
    $min = $data['min']?? 0;
    $max = $data['max']?? 100000;
    $saleP = $data['sale']?? 0;
    $newP = $data['new']?? 0;  
    
    // выбор товаров по категории
    if(isset($data['categoryChange'])) {
        $catChange = $data['categoryChange'];
        if($data['categoryChange'] > 0) {
            $req .= " JOIN products_sections as ps ON ps.`id_prod`=products.`product_id` where ps.`id_section`=" .$catChange;
            if($saleP>0 && $newP == 0){
                $req .= ' and sale='.$saleP." ";
            } elseif($newP>0 && $saleP == 0){
                $req .= ' and new='.$newP." ";
            } elseif($newP > 0 && $saleP > 0) {
                $req .= ' and new='.$newP.' and sale='.$saleP." ";
            } 
        }
    }
    // фильтр товаров по кнопке ПРИМЕНИТЬ
    if(isset($data['aside']) && $data['aside'] == 'button'){   
        if(isset($data['category']) && $data['category'] > 0) {
            $category = $data['category'];
            $req .= " JOIN products_sections as ps ON ps.`id_prod`=products.`product_id` where ps.`id_section`='$category' and products.`price` between '$min' and '$max' ";
            if($saleP>0 && $newP == 0){
                $req .= ' and sale='.$saleP." ";
            } elseif($newP>0 && $saleP == 0){
                $req .= ' and new='.$newP." ";
            } elseif($newP > 0 && $saleP > 0) {
                $req .= ' and new='.$newP.' and sale='.$saleP." ";
            } 
        } else {
             $req .= " where products.`price` between ".$min.' and '.$max;               
            if($saleP>0 && $newP == 0){
                $req .= ' and sale='.$saleP." ";
            } elseif($newP>0 && $saleP == 0){
                $req .= ' and new='.$newP." ";
            } elseif($newP > 0 && $saleP > 0) {
                $req .= ' and new='.$newP.' and sale='.$saleP." ";
            }
        }
    } 

    if(isset($data['pagination']) && $data['pagination'] == 'on' && !isset($data['categoryChange'])) {
        if($saleP>0 && $newP == 0){
            $req .= ' where sale='.$saleP." ";
        } elseif($newP>0 && $saleP == 0){
            $req .= ' where new='.$newP." ";
        }
    }
            
    if(isset($data['sort']) && $data['sort'] !== ''){
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
// построение запроса в БД исходя из полученных данных на страницеи НОВИНКИ
function getRequestNew($data, $num, $start, $reqStart = "SELECT * from products "){
    if(isset($data['page']) && $data['page'] !== ''){
        $start = ($data['page'] * $num) - $num;
    } else {
        $start = 0;
    }    
    $req = $reqStart;   
    $min = $data['min']?? 0;
    $max = $data['max']?? 100000;
    $saleP = $data['sale']?? 0;
    $newP = 1;  
    
    // выбор товаров по категории
    if(isset($data['categoryChange'])) {
        $catChange = $data['categoryChange'];
        if($data['categoryChange'] > 0) {
            $req .= " JOIN products_sections as ps ON ps.`id_prod`=products.`product_id` where ps.`id_section`='$catChange' and new=1 ";
            if($saleP>0){
                $req .= ' and sale='.$saleP." ";
            }
        }
    } elseif(isset($data['aside']) && $data['aside'] == 'button'){   
    // фильтр товаров по кнопке ПРИМЕНИТЬ
    
        if(isset($data['category']) && $data['category'] > 0) {
            $category = $data['category'];
            $req .= " JOIN products_sections as ps ON ps.`id_prod`=products.`product_id` where ps.`id_section`='$category' and products.`price` between '$min' and '$max' and new=1 ";
            if($saleP>0){
                $req .= ' and sale='.$saleP." ";
            }
        } else {
             $req .= " where products.`price` between ".$min.' and '.$max . ' and new=1 ';               
             if($saleP>0){
                $req .= ' and sale='.$saleP." ";
            }
        }
    } else {
        $req .= " where new=1 ";
    }
            
    if(isset($data['sort']) && $data['sort'] !== ''){
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

// построение запроса в БД исходя из полученных данных на страницеи SALE
function getRequestSale($data, $num, $start, $reqStart = "SELECT * from products "){
    if(isset($data['page']) && $data['page'] !== ''){
        $start = ($data['page'] * $num) - $num;
    } else {
        $start = 0;
    }    
    $req = $reqStart;   
    $min = $data['min']?? 0;
    $max = $data['max']?? 100000;
    $newP = $data['new']?? 0;
    $saleP = 1;  
    
    // выбор товаров по категории
    if(isset($data['categoryChange'])) {
        $catChange = $data['categoryChange'];
        if($data['categoryChange'] > 0) {
            $req .= " JOIN products_sections as ps ON ps.`id_prod`=products.`product_id` where ps.`id_section`='$catChange' and sale=1 ";
            if($newP>0){
                $req .= ' and new='.$newP." ";
            }
        }
    } elseif(isset($data['aside']) && $data['aside'] == 'button'){   
    // фильтр товаров по кнопке ПРИМЕНИТЬ
    
        if(isset($data['category']) && $data['category'] > 0) {
            $category = $data['category'];
            $req .= " JOIN products_sections as ps ON ps.`id_prod`=products.`product_id` where ps.`id_section`='$category' and products.`price` between '$min' and '$max' and sale=1 ";
            if($newP>0){
                $req .= ' and new='.$newP." ";
            }
        } else {
             $req .= " where products.`price` between ".$min.' and '.$max . ' and sale=1 ';               
             if($newP>0){
                $req .= ' and new='.$newP." ";
            }
        }
    } else {
        $req .= " where sale=1 ";
    }
            
    if(isset($data['sort']) && $data['sort'] !== ''){
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
    if(isset($_GET['category']) && $_GET['category'] == $row['id']){
        $active = 'active';
    } elseif(isset($_GET['categoryChange']) && $_GET['categoryChange'] == $row['id']) {
        $active = 'active';
    } else {
        $active = 'AAA';
    }
    ?>
    <li>
    <a class="filter__list-item <?=$active?>" href="/?category=<?=$row['id']?>" name="<?=$row['id']?>"><?=$row['name']?></a>
    </li>
    <?php }  
}

// добавление заказа в БД
function addNewOrder($connect, $date, $productPrice, $name, $surname, $thirdname, $email, $phone, $delivery, $payment, $status, $comments, $city, $street, $home, $aprt, $productId) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        return $err;
    } else {
        $req=mysqli_query($connect, "INSERT into orders (date, price, user_name, user_surname, user_thirdname, email, phone, delivery, payment, status, comments, city, street, home, aprt, product_id)
        values ('$date', '$productPrice', '$name', '$surname', '$thirdname', '$email', '$phone', '$delivery', '$payment', '$status', '$comments', '$city', '$street', '$home', '$aprt', '$productId')");
        if($req) {
            return 'ok';
        } else {
            return 'error';
        }       
    }
}

// получение из БД списка заказов 
function getOrders($connect) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        return mysqli_query($connect, "SELECT * from orders ORDER BY status DESC, id DESC");
    }
}

// Вывод всех заказов
function showOrders($connect, $orders) {
    while($row = mysqli_fetch_assoc($orders)) { 
        $id = $row['id'];
        $name = $row['user_name'];
        $surname = $row['user_surname'];
        $thirdname = $row['user_thirdname'];
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
            <span class="order-item__info"><?=$name?> <?=$thirdname?> <?=$surname?></span>
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
    $result = mysqli_query($connect, "SELECT price from products where product_id=".(int)$id);
    while($row = mysqli_fetch_assoc($result)) {
        $price = $row['price'];
    }
    return $price;
}

// получение названия файла изображения продукта
function getImage($connect, $id) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        $result = mysqli_query($connect, "SELECT img from products where product_id = '$id'");
        while($row = mysqli_fetch_assoc($result)) {
            return $row['img'];
        }
    }
}

// функции валидации формы

function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    
    return $value;
}

function check_length($value = "", $min, $max) {
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return !$result;
}

function getMaxRange($connect) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        $max = mysqli_query($connect, "SELECT MAX(price) from products");
        while($row = mysqli_fetch_assoc($max)) {
            return $row['MAX(price)'];
        }
    }
}

function getMinRange($connect) {
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        exit();
    } else {
        $max = mysqli_query($connect, "SELECT MIN(price) from products");
        while($row = mysqli_fetch_assoc($max)) {
            return $row['MIN(price)'];
        }
    }
}

function getDeliveryDate($interval) {
    $date = new DateTime();
    $date->modify('+'.$interval.' day');
    echo $date->format('d / m');
}
