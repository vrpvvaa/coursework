<?php
require_once "Admin.php";
require_once "../Application.php";
session_start();

$application = new Application;


if ($application->create_service($_POST["name"], $_POST["sallary"], $_POST["id_category"], $_POST["descr"])) {
    $_SESSION["message"] = 'Услуга добавлена!';
    header("Location: /admin\index.php");
}else{
    $_SESSION["message"] = "Ошибка добавления!";
    header("Location: /admin\create_service.php");
}