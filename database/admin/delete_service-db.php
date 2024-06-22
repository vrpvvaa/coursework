<?php
$con = mysqli_connect("localhost", "root", "", "theLADKA");
session_start();
$id = isset($_GET['id']) ? $_GET['id'] : false;

if ($id) {
    $sql = "DELETE FROM `service` WHERE id_service = $id";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["message"] = "Услуга удалена";
        header("Location: /admin/service_adm.php");
    } else {
        $_SESSION["message"] = "Ошибка удаления услуги";
        header("Location: /admin/service_adm.php");
    }
}
