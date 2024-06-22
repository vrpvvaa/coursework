<?php
require_once "Admin.php";
session_start();

$user = new Admin();
$result = $user->signupMaster($_POST["name"], $_POST["lastname"], $_POST["email"], $_FILES, $_POST["id_category"], $_POST["password"], $_POST["role"]);
if ($user->check_email == true) {
    $_SESSION["message"] = "Мастер успешно зарегистрирован!";
    header("Location: /admin");
} else {
    $_SESSION["message"] = "Ошибка регистрации!";
    header("Location: ../admin/signup_master.php");
}
?>
