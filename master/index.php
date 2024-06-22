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

<section class="account_container">
    <div class="personal-cabinet">
        <div class="personal-info">
            <img src="../img/other/h2.jpg" alt="Client">
            <form method="post" action="../database/user/update-user.php">
                <input type="text" name="name" placeholder="Имя" value="<?= htmlspecialchars($user_current['name']) ?>">
                <input type="text" name="lastname" placeholder="Фамилия" value="<?= htmlspecialchars($user_current['lastname']) ?>">
                <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($user_current['email']) ?>">
                <input type="password" name="password" placeholder="Пароль" value="<?= htmlspecialchars($user_current['password']) ?>">
                <button type="submit">СОХРАНИТЬ</button>
            </form>
        </div>
        <div class="appointments">
            <pre>Добро пожаловать, <?= $name ?></pre>
            <h2>ВАШИ ЗАПИСИ</h2>
            <?php if (count($all_applications) != 0) {
                foreach ($all_applications as $appl) { ?>
                    <div class="appointment">
                    <div class="details">
                            <p>Услуга: <?= $appl[3] ?></p>
                            <p>Клиент: <?= $appl[9] . " " . $appl[10] ?></p>
                            <p>Дата: <?= $appl[1] ?></p>
                            <p>Время: <?= $appl[2] ?></p>
                        </div>
                        <div class="price">
                            <p>Прибыль</p>
                            <?= $appl[4] ?> Р
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="details_no">
                    <p>У вас нет записей!</p>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
include "../footer.php";
?>