<?php

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
?>
<main class="shop-page">
  <header class="intro">
    <div class="intro__wrapper">
      <h1 class=" intro__title">COATS</h1>
      <p class="intro__info">Collection 2021</p>
    </div>
  </header>
  <section class="shop container">
    <section class="shop__filter filter">
      <form method="get" id="form-filter">
        <div class="filter__wrapper">
          <b class="filter__title">Категории</b>
          <ul class="filter__list">
          <?php
            if(isset($_GET['category'])){ ?>               
                <li>
                  <a class="filter__list-item" href="all" name=0>ВсеВсеВсе</a>
                </li>
            <?php  } else { ?>
              <li>
                <a class="filter__list-item active" href="all" name=0>ВсеВсеВсе</a>
              </li>
            <?php } 
            getSectionList($connect); ?>            
          </ul>
        </div>
        <div class="filter__wrapper">
          <b class="filter__title">Фильтры</b>
          <div class="filter__range range">
            <span class="range__info">Цена</span>
            <div class="range__line" aria-label="Range Line"></div>
            <div class="range__res">
              <span class="range__res-item min-price">350 руб.</span>
              <span class="range__res-item max-price">32000 руб.</span>
            </div>
          </div>
        </div>

        <fieldset class="custom-form__group">
          <input type="checkbox" name="new" id="new" class="custom-form__checkbox">
          <label for="new" class="custom-form__checkbox-label custom-form__info" style="display: block;">Новинка</label>
          <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox">
          <label for="sale" class="custom-form__checkbox-label custom-form__info"
            style="display: block;">Распродажа</label>
        </fieldset>
        <button class="button" type="submit" style="width: 100%" id="filter-button">Применить</button>
      </form>
    </section>

    <div class="shop__wrapper">
      <section class="shop__sorting">
        <div class="shop__sorting-item custom-form__select-wrapper">
          <select class="custom-form__select" name="category" id="sortBy">
            <option hidden="">Сортировка</option>
            <option class="option" value="sortByPrice">По цене</option>
            <option class="option" value="sortByName">По названию</option>
          </select>
        </div>
        <div class="shop__sorting-item custom-form__select-wrapper">
          <select class="custom-form__select" name="prices" id="sortOrder">
            <option hidden="">Порядок</option>
            <option value="on">По возрастанию</option>
            <option value="reverse">По убыванию</option>
          </select>
        </div>
        