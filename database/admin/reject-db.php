<?php
$con = mysqli_connect("localhost", "root", "", "theLADKA");
session_start();
$id = isset($_GET['id']) ? $_GET['id'] : false;

if ($id) {
    $sql = "UPDATE `booking` SET `status`=3 WHERE `id_book` = $id";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["message"] = "Статус изменен";
        header("Location: /admin/masters_adm.php");
    } else {
        $_SESSION["message"] = "Ошибка смены статуса";
        header("Location: /admin/masters_adm.php");
    }
}
