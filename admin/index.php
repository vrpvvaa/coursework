<?php
include "../header.php";

$check = isset($_SESSION["id_user"]) ? true : false;

if ($check) {
    $name = $_SESSION["name"];
    require_once '..\database\User.php';
    $user = new User();
    $user_current = $user->selectDataUser($_SESSION["id_user"]);
}

if (isset($_SESSION["message"])) {
    $mes = $_SESSION["message"];
    echo "<script>alert('$mes')</script>";
    unset($_SESSION["message"]);
}
require_once "../database/Connect.php";
require_once "../database/Application.php";
$id_user = $_SESSION['user_id'];

$applications = new Application();

$all_applications = $applications->get_applications_master();
?>

<section class="account_admin">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Панель управления</title>
    </head>

    <body>
        <div class="admin-panel">
                <pre>Добро пожаловать, <?= $name ?></pre>
                <h2>Панель усправления</h2>
                <div class="service-blockk">
                    <a href="masters_adm.php"><button class="service-button">Мастера</button></a>
                </div>
                <div class="service-blockk">
                    <a href="service_adm.php"><button class="service-button">Услуги</button></a>
                </div>
                <div class="service-blockk">
                    <a href="create_service.php"><button class="service-button">Добавить услугу</button></a>
                </div>
                <div class="service-blockk">
                    <a href="signup_master.php"><button class="service-button">Добавить мастера</button></a>
                </div>
            </div>
        </div>
    </body>

</section>

<?php
include "../footer.php";
?>