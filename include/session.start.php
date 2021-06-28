<?php
error_reporting(E_ALL);

if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = date("H:i:s");
}

if (isset($_GET['logout']) && $_GET['logout'] === 'on') {
    // удаляем все куки
    unset($_COOKIE['authorized']);
    setcookie('authorized', null, time() - 60*60*24, '/');
    header('Location: /index.php');
}
