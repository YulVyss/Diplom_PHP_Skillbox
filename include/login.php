<?php

// var_dump($_POST);
$isAuth = false;
$current_login = htmlspecialchars($_POST['current_login'] ?? '');
$current_password = htmlspecialchars($_POST['current_password'] ?? '');
$conn = mysqli_connect('localhost', 'mysql', 'mysql', 'fashion');
if (!empty($_POST['current_login'] && !empty($_POST['current_password']))) {
     // проверка логина и пароля
    $query = mysqli_query($conn,"SELECT login, password FROM `fashion`.`users` WHERE login ='".mysqli_real_escape_string($conn, $_POST['current_login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    mysqli_close($conn);
    if ($current_login == $data['login'] && password_verify($current_password, $data['password']))  {
        $isAuth = true;
        $_SESSION['authorized'] = 'true';
        $_SESSION['current_login'] = $current_login;
        $_SESSION['current_password'] = $current_password;
        setcookie('authorized', $current_login, time() + 60*60*24*30, '/');
        
    }
}
if (isset($_COOKIE['authorized'])) {
    setcookie('authorized', $_COOKIE['authorized'], time() + 60*60*24*30, '/');
}