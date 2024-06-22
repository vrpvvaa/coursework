<?php
$con = mysqli_connect("localhost", "root", "", "theLADKA");
session_start();
$id = isset($_GET['id']) ? $_GET['id'] : false;

if ($id) {
    $sql = "UPDATE `booking` SET `status`=2 WHERE `id_book` = $id";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $query = mysqli_fetch_assoc(mysqli_query($con, "SELECT booking.*, user.email FROM booking INNER JOIN user ON booking.id_user = user.id_user WHERE id_book = $id;"));
        $email = $query["email"];
        $_SESSION["message"] = "Статус изменен, на почту отправлено уведомление!";
        header("Location: /admin/masters_adm.php");
        $subject = 'Ваше бронирование подтверждено!';
        $message = "<main>

    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

    <section style='height:500px; text-align:center;'>
        <h2 style='margin:60px;color:#ff3399;font-size: 40px;'>The LADKA</h2>

        <p style='margin:60px;font-size:20px'>Ваше бронирование подтверждено!</p>
        <p style='margin:60px;font-size:20px'>Будем рады видеть Вас на процедуре в нашем салоне!</p>
        <p style='margin:60px;font-size:15px;font-style:italic;opacity:0.8;'>Более подробная информация в Вашем личном кабинете. <br> С любовью The LADKA
        </p>
    </section>
</main>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($email, $subject, $message, $headers);
    } else {
        $_SESSION["message"] = "Ошибка смены статуса";
        header("Location: /admin/masters_adm.php");
    }
}
