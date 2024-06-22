<?php

require_once "database/User.php";

session_start();
$check = isset($_SESSION["id_user"]) ? true : false;

if ($check) {
    $name = $_SESSION["name"];
}

if (isset($_SESSION["message"])) {
    $mes = $_SESSION["message"];
    echo "<script>alert('$mes')</script>";
    unset($_SESSION["message"]);
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>The Ladka</title>
    <link rel="stylesheet" href="\style.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="\img\icon\logo2.png" alt="The Ladka Logo">
            </div>
            <ul>
                <li><a href="\service.php">Услуги</a></li>
                <li><a href="\masters.php">Мастера</a></li>
                <li><a href="\index.php">О нас</a></li>
            </ul>
            <div class="auth-buttons">
                <?php if (!$check) { ?>
                    <div class="exit">
                        <a href="\signin.php"><button>Войти</button></a>
                        <a href="\signup.php"><button>Зарегистрироваться</button></a>
                    </div>
                <?php } else { ?>
                    <div class="exit">
                        <img src="\images\free-icon-user-848043 2.png" alt="">
                        <a href="\signout.php"><button>Выйти</button></a>
                        <?php if ($_SESSION['role'] == 1){ ?>
                        <a href="\user\"><button>Личный кабинет</button></a>
                        <?php } ?>
                        <?php if ($_SESSION['role'] == 2){ ?>
                        <a href="\master\"><button>Личный кабинет</button></a>
                        <?php } ?>
                        <?php if ($_SESSION['role'] == 3){ ?>
                        <a href="\admin\"><button>Личный кабинет</button></a>
                        <?php } ?>
                    </div>
                <?php } ?>


            </div>
        </nav>
    </header>