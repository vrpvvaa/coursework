
<?php
require_once "../database/User.php";
session_start();

$user = new User();
$result = $user->signup($_POST["name"], $_POST["lastname"], $_POST["email"], $_POST["password"], $_POST["role"]);
if ($user->check_email==true) {//проверка пришла ошибка или нет
    $_SESSION["message"] = "Вы успешно зарегистрировались!";
    header("Location:/signin.php");
}
else{
    $_SESSION["message"] = "Ошибка регистрацииa!";
    header("Location:/signup.php");
}
?> 
