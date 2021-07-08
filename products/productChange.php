<?php 
if (!isset($_COOKIE['authorized'])) {
  header("Location: //admin/index.php"); 
  exit();
}
include $_SERVER['DOCUMENT_ROOT'] . '/template/header_adm.php';

if(isset($_GET['id']) && $_GET['id'] > 0) {
  $id = $_GET['id'];
  $data = mysqli_query($connect, "SELECT * from products where id='$id' ");
  while($row = mysqli_fetch_assoc($data)) {
    $name = $row['name'];
    $price = $row['price'];
    $section = $row['category_id'];
    $new = $row['new'];
      
    if($new === 0) {
      $checked = '';
    } else {
      $checked = 'checked';
    }
  }
}
?>
<main class="page-add">  
  <h1 class="h h--1">Изменение товара</h1>
  <form class="custom-form" action="form.php" id='changeProduct'  method="post" enctype="multipart/form-data">
    <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Данные о товаре</legend>
      <label for="product-name" class="custom-form__input-wrapper page-add__first-wrapper">
        <input type="text" class="custom-form__input" name="product-name" id="product-name" required value='<?=$name ?>'>
        <p class="custom-form__input-label" hidden>
          Название товара
        </p>
      </label>
      <label for="product-price" class="custom-form__input-wrapper">
        <input type="text" class="custom-form__input" name="product-price" id="product-price" required value=<?=$price?>>
        <p class="custom-form__input-label" hidden>
          Цена товара
        </p>
      </label>
    </fieldset>
    <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Фотография товара</legend>
      
      <ul class="add-list">
        <li class="add-list__item add-list__item--add" hidden>
          <input type="file" name="product-photo" id="product-photo" hidden="">
          <label for="product-photo">Добавить фотографию</label>
        </li>
      <?php 
      if(isset($_GET['id']) &&$_GET['id'] > 0) { ?>
        <li class="add-list__item add-list__item--active">
          <img src="../img/products/<?=getImage($connect, $_GET['id']); ?>">
        </li>
      <?php } else { ?>
        <li class="add-list__item add-list__item--add"></li>
      <?php } ?>
      </ul>
    </fieldset>
    <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Раздел</legend>
      <div class="page-add__select">
        <select name="category" id="category" class="custom-form__select">
          <option name='<?php getSectionName($connect) ?>'  hidden="">Название раздела</option>
          <?php getSectionName($connect, $section); ?>
        </select>
      </div>
      <input type="checkbox" name="new" id="new" class="custom-form__checkbox" <?=$checked?>>
      <label for="new" class="custom-form__checkbox-label">Новинка</label>
      <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox">
      <label for="sale" class="custom-form__checkbox-label">Распродажа</label>
    </fieldset>
    <button class="button changeProduct" type="submit" name="submit" value="submit">Сохранить изменения</button>
  </form>
  <section class="shop-page__popup-end page-add__popup-end" hidden="">
    <div class="shop-page__wrapper shop-page__wrapper--popup-end">
      <h2 class="h h--1 h--icon shop-page__end-title">Товар <span class='product__added'></span> успешно изменен</h2>      
    </div>
  </section>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'; ?>