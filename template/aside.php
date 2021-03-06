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
            if(!isset($_GET['category']) && !isset($_GET['categoryChange'])) { ?>               
              <li>
                <a class="filter__list-item active" href="all" name='0'>Все</a>
              </li>
          <?php } else { ?>
              <li>
                <a class="filter__list-item" href="all" name='0'>Все</a>
              </li>
            <?php } 
              getSectionList($connect); ?>            
          </ul>
        </div>
        <div class="filter__wrapper">
          <b class="filter__title">Фильтры</b>
          <div class="filter__range range">
            <span class="range__info">Цена</span>
            <span class="range__info min-range" hidden data-val="<?=getMinRange($connect)?>"><?=getMinRange($connect)?></span>
            <span class="range__info max-range" hidden data-val="<?=getMaxRange($connect)?>"><?=getMaxRange($connect)?></span>
            <div class="range__line" aria-label="Range Line"></div>
            <div class="range__res">
              <span class="range__res-item min-price"><?=getMinRange($connect)?> руб.</span>
              <span class="range__res-item max-price"><?=getMaxRange($connect)?> руб.</span>
            </div>
          </div>
        </div>
        <fieldset class="custom-form__group">
        <?php if (isset($_REQUEST['new']) && $_REQUEST['new'] == 1) { ?>
          <input type="checkbox" name="new" id="new" class="custom-form__checkbox " checked >
        <?php } else { ?>
          <input type="checkbox" name="new" id="new" class="custom-form__checkbox " >
        <?php } ?>
        <label for="new" class="custom-form__checkbox-label custom-form__info" style="display: block;">Новинка</label>
        <?php if (isset($_REQUEST['sale']) && $_REQUEST['sale'] == 1) { ?>
          <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox" checked>
        <?php } else { ?>
          <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox">
        <?php } ?>          
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
            <?php 
            if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 'sortByPrice') { ?>
              <option class="option" value="sortByPrice" selected>По цене</option>
            <?php } else { ?>
              <option class="option" value="sortByPrice">По цене</option>
              <?php } 
              if(isset($_REQUEST['sort']) && $_REQUEST['sort'] == 'sortByName') { ?>
                <option class="option" value="sortByName" selected>По названию</option>         
              <?php } else { ?>
                <option class="option" value="sortByName">По названию</option>
              <?php } ?>
          </select>
        </div>
        <div class="shop__sorting-item custom-form__select-wrapper">
          <select class="custom-form__select" name="prices" id="sortOrder">
            <option hidden="">Порядок</option>
            <?php 
            if(isset($_REQUEST['order']) && $_REQUEST['order'] == 'on') { ?>
              <option value="on" selected>По возрастанию</option>
            <?php } else { ?>
              <option value="on">По возрастанию</option>
              <?php }  ?>
              <?php 
            if(isset($_REQUEST['order']) && $_REQUEST['order'] == 'reverse') { ?>
              <option value="reverse" selected>По убыванию</option>
            <?php } else { ?>
              <option value="reverse">По убыванию</option>
              <?php }  ?>        
          </select>
        </div>
        