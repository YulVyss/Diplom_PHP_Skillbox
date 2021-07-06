<?php
include $_SERVER['DOCUMENT_ROOT'] . '/constant.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/functions.php';

$isAuth = false;
$current_login = htmlspecialchars($_POST['current_login'] ?? '');
$current_password = htmlspecialchars($_POST['current_password'] ?? '');

if (isset($_POST['current_login']) && isset($_POST['current_password']) && !empty($_POST['current_login'] && !empty($_POST['current_password']))) {
     // проверка логина и пароля
    $query = mysqli_query($connect,"SELECT * FROM users WHERE login ='".mysqli_real_escape_string($connect, $_POST['current_login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    
    if ($current_login == $data['login'] && password_verify($current_password, $data['password']))  {
        $isAuth = true;
        $_SESSION['authorized'] = 'true';
        $_SESSION['current_login'] = $current_login;
        $_SESSION['current_password'] = $current_password;
        setcookie('authorized', $current_login, time() + 60*60*24, '/');
        if($data['rights'] === 'admin'){
            echo json_encode(1); 
        } elseif($data['rights'] === 'operator') {
            echo json_encode(2); 
        } else {
            echo json_encode($data['name']); 
        }        
    } else {
        echo json_encode('false');
    }
    mysqli_close($connect);   
}
