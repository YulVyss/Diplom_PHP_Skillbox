<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/header_adm.php'; 

?>
<main class="page-authorization">
  <h1 class="h h--1">Авторизация</h1>
  <!-- <form class="custom-form" action="/?login=yes" method="post"> -->
  <form class="custom-form" action="" method="post" id="authorization">
  <?php if (isset($_COOKIE['authorized'])) { ?>
    <input type="email" class="custom-form__input" hidden name="current_login" value="<?=$current_login=htmlspecialchars($_COOKIE['authorized'])?>">
<?php } else { ?>
    <input type="email" class="custom-form__input" required name="current_login" value="<?=$current_login?>">
<?php } ?>
    <input type="password" class="custom-form__input" required name="current_password" value="<?= $current_password ?>">
    <button class="button" type="submit">Войти в личный кабинет</button>
    <!-- <a href="/php_diplom/products/" class="button">личный кабинет</a> -->
  </form>
</main>
<div class="response"></div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php_diplom/template/footer.php';