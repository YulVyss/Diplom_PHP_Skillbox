<?php
// $host = 'localhost';
// $user = 'u0936993_default'; //имя пользователя
// $password = '7X4b5A2h'; //пароль
// $bdname = 'u0936993_wp-1'; // название БД

$fld = '/php_diplom';
$host = 'localhost';
$user = 'mysql'; //имя пользователя
$password = 'mysql'; //пароль
$bdname = 'fashion'; // название БД
$login = $_SESSION['current_login'] ?? '';

$counter = 0;
$start = 0;
$num = 3;
$page = 1;

