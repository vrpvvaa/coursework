<?php

session_start();

$con = mysqli_connect("localhost", "root", "", "theLADKA");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['id_user'];

$name = isset($_POST["name"]) ? trim($_POST["name"]) : null;
$lastname = isset($_POST["lastname"]) ? trim($_POST["lastname"]) : null;
$email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
$password = isset($_POST["password"]) ? trim($_POST["password"]) : null;

// Создаем массив для хранения изменений
$updates = [];
if ($name !== null)
    $updates[] = "name='$name'";
if ($lastname !== null)
    $updates[] = "lastname='$lastname'";
if ($email !== null && filter_var($email, FILTER_VALIDATE_EMAIL))
    $updates[] = "email='$email'";
if ($password !== null)
    $updates[] = "password='$password'";

// Проверяем, есть ли что обновлять
if (count($updates) > 0) {
    $sql = "UPDATE `user` SET " . implode(', ', $updates) . " WHERE `id_user`=$id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION["message"] = "Данные успешно обновлены!";
    } else {
        $_SESSION["message"] = "Ошибка обновления данных: " . mysqli_error($con);
    }
} else {
    $_SESSION["message"] = "Нет изменений для обновления.";
}

mysqli_close($con);

if ($_SESSION['role'] == 1) {
    header("Location: ../../user");
} if ($_SESSION['role'] == 2) {
    header("Location: ../../master");
} 

exit();
?>