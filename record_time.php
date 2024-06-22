<?php
session_start();
// require_once "database/connect.php";
$con = mysqli_connect("localhost", "root", "", "theLADKA");

// var_dump($_POST);




$id_master = $_POST['id_master']; // Здесь должно быть 'id_master', а не 'master'
$date = $_POST['date'];
$occupied_time = [];

// Предположим, что в таблице master есть поле id_user, которое хранит id мастера
$res = mysqli_query($con, "SELECT `id_master` FROM `master` WHERE `id_user` = $id_master");
// var_dump("SELECT `id_master` FROM `master` WHERE `id_user` = 1");
$id_master_data = mysqli_fetch_array($res);
$id_master = $id_master_data['id_master'];

// print_r($id_master);

$result = mysqli_query($con, "SELECT `time` FROM booking WHERE `id_master` = $id_master and `date` = '$date' and `status` in (1,2)");
if($result){
  
while ($time = mysqli_fetch_array($result)) {
    $occupied_time[] = $time['time'];
}  
}


$start = 9;
$end = 21;
$times = "";
$free_time = [];

for ($i = $start; $i < $end; $i++) {
    if ($start == $end)
        break;
    $times = (string) $i;
    $times .= ":00:00";


    if (!in_array($times, $occupied_time)) {
        $free_time[] = $times;
    }
}

echo json_encode($free_time);
?>