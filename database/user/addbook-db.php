<?php
require_once "..\Application.php";
session_start();

// $application = new Application;
$con = mysqli_connect("localhost", "root", "", "theLADKA");
// if ($application->create($_POST["date"], $_POST["time"], $_POST["id_service"], $_POST["master"])) {
//     $_SESSION["message"] = 'Услуга забронирована!';
//     header("Location: /user\index.php");
// }else{
//     $_SESSION["message"] = "Ошибка бронирования!";
//     header("Location: /user\index.php");
// }


$id_auth_user = $_SESSION['id_user'];

$id_service = isset($_POST["id_service"]) ? $_POST["id_service"] : false;
$name = isset($_POST["name"]) ? $_POST["name"] : false;
$date = isset($_POST["date"]) ? $_POST["date"] : false;
$time = isset($_POST["time"]) ? $_POST["time"] : false;
  $master = isset($_POST["master"]) ? $_POST["master"] : false;


// $id_card = mysqli_fetch_assoc(mysqli_query($con,"SELECT id_card FROM `card` WHERE card.id_user = '$name'"))["id_card"];
// $id_doctor = mysqli_fetch_assoc(mysqli_query($con,"SELECT id_doctor FROM `doctor` WHERE doctor.id_user = '$id_auth_doctor'"))["id_doctor"];


if ($date && $time) {
    $sql = mysqli_query($con, "INSERT INTO `booking`(`id_user`, `date`, `time`, `id_service`, `id_master`, `status`) 
    VALUES ('$id_auth_user','$date','$time','$id_service','$master ','0')");
    
    if ($sql) {
        $_SESSION["message"] = "Услуга забронирована!";
        header("location: ../../user"); 
    } else {
        $_SESSION["message"] = "Ошибка бронирования!";
        header("location: ../../service.php");
    }
} else {
    $_SESSION["message"] = "Не все необходимые данные были предоставлены!";
    header("location: ../../service.php");
}
