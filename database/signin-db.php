<?php
require_once "../database/User.php";
session_start();
$user = new User();

$user->signin($_POST["email"], $_POST["password"]);


var_dump($user->check_email);


if (is_null($user->check_email)) { // Проверяем, что результат не пустой 
    if ($_SESSION["role"] == "3") {//проверка на роль 
        $_SESSION["message"] = "Вы вошли как администратор";
        header('Location: \admin\index.php');
    }
    if ($_SESSION['role'] == 2) {
        $_SESSION["message"] = "Вы вошли как мастер";
        header('Location: ..\master\index.php');
    }
    if ($_SESSION['role'] == 1) {
        $_SESSION["message"] = "Вы вошли как пользователь";
        header('Location: ..\user\index.php');
    }
} else {
    if ($user->check_email == true) {
        $_SESSION["message"] = "Ошибка авторизации! Неправильный пароль."; // Выводим сообщение об ошибке
        header("Location:/signin.php");
    } else if ($user->check_email == false) {
        $_SESSION["message"] = "Такой пользователь не найден!"; // Выводим сообщение об ошибке
        header("Location:/signin.php");
    }
}
