<main class="shop-page">
  <header class="intro">
    <div class="intro__wrapper">
      <h1 class=" intro__title">COATS</h1>
      <p class="intro__info">Collection 2018</p>
    </div>
  </header>
  <section class="shop container">
    <section class="shop__filter filter">
      <form method="get">
        <div class="filter__wrapper">
          <b class="filter__title">Категории</b>
          <ul class="filter__list">
            <li>
              <a class="filter__list-item active" href="all">ВсеВсеВсе</a>
            </li>
            <li>
              <a class="filter__list-item" href="women">Женщины</a>
            </li>
            <li>
              <a class="filter__list-item" href="men">Мужчины</a>
            </li>
            <li>
              <a class="filter__list-item" href="kids">Дети</a>
            </li>
            <li>
              <a class="filter__list-item" href="accessories">Аксессуары</a>
            </li>
            <li>
              <a class="filter__list-item" href="footwear">Обувь</a>
            </li>
          </ul>
        </div>
        <div class="filter__wrapper">
          <b class="filter__title">Фильтры</b>
          <div class="filter__range range">
            <span class="range__info">Цена</span>
            <div class="range__line" aria-label="Range Line"></div>
            <div class="range__res">
              <span class="range__res-item min-price">350 руб.</span>
              <span class="range__res-item max-price">32 000 руб.</span>
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
        <button class="button" type="submit" style="width: 100%">Применить</button>
      </form>
    </section>

    <div class="shop__wrapper">
      <section class="shop__sorting">
        <div class="shop__sorting-item custom-form__select-wrapper">
          <select class="custom-form__select" name="category" method="get">
            <option hidden="">Сортировка</option>
            <option class="option" value="price">По цене</option>
            <option class="option" value="name">По названию</option>
          </select>
        </div>
        <div class="shop__sorting-item custom-form__select-wrapper">
          <select class="custom-form__select" name="prices">
            <option hidden="">Порядок</option>
            <option value="all">По возрастанию</option>
            <option value="woman">По убыванию</option>
          </select>
        </div>
        <p class="shop__sorting-res">Найдено <span class="res-sort">858</span> моделей</p>
      </section>