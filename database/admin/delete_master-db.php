<?php
$con = mysqli_connect("localhost", "root", "", "theLADKA");
session_start();
$id = isset($_GET['id']) ? $_GET['id'] : false;

if ($id) {
    $sql = "DELETE FROM `user` WHERE id_user = $id";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["message"] = "Мастер удален";
        header("Location: /admin/master_adm.php");
    } else {
        $_SESSION["message"] = "Ошибка удаления мастера";
        header("Location: /admin/master_adm.php");
    }
}
