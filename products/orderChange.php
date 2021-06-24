<?php
include $_SERVER['DOCUMENT_ROOT'] . '/template/header_adm.php';
// изменение статуса заказа во вкладке Заказы
if($_POST['statusOrder']) {
    $status = $_POST['statusOrder'];
    $id = $_POST['id'];
    // $connect = mysqli_connect($host, 'mysql', 'mysql', $bdname);
    if (mysqli_connect_errno()) {
        $err = "Ошибка ".mysqli_connect_error();
        echo $err;
    } else {
        mysqli_query($connect, "UPDATE orders SET status='$status' where id='$id'");
        echo $status;
    }
    exit();
}