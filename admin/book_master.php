<?php
include "../header.php";

$check = isset($_SESSION["id_user"]) ? true : false;

if ($check) {
    $name = $_SESSION["name"];
    require_once '..\database\User.php';
    $user = new User();
    $id_user = $_GET["id"];
    $user_current = $user->selectDataUser($id_user);
}

if (isset($_SESSION["message"])) {
    $mes = $_SESSION["message"];
    echo "<script>alert('$mes')</script>";
    unset($_SESSION["message"]);
}
// require_once "../database/Connect.php";
// require_once "../database/Application.php";
$id_user = $_GET["id"];

$con = mysqli_connect("localhost", "root", "", "theLADKA");

$query = "SELECT
        booking.id_book,
        booking.date,
        booking.time,
        service.name_service,
        service.sallary,
        u2.name AS master_name,
        u2.lastname AS master_lastname,
        category.name_category,
        booking.status,
        u1.name AS user_name,      -- Имя пользователя
        u1.lastname AS user_lastname  -- Фамилия пользователя
    FROM 
        booking
    INNER JOIN 
        USER AS u1 ON booking.id_user = u1.id_user
    INNER JOIN 
        service ON booking.id_service = service.id_service
    INNER JOIN 
        MASTER ON booking.id_master = MASTER.id_master
    INNER JOIN 
        USER AS u2 ON MASTER.id_user = u2.id_user  -- Второе соединение с таблицей пользователей для получения имени мастера
    INNER JOIN 
        category ON service.id_category = category.id_category
    WHERE 
        MASTER.id_user = $id_user";
$appls = mysqli_fetch_all(mysqli_query($con, $query));

$status = [
    "Новая",
    "Принята",
    "Отклонена"
]

?>
<section class="account_container">
    <div class="personal-cabinet">
        <div class="personal-info">
            <img src="../img/other/h2.jpg" alt="Client">
            <form method="post" action="../database/user/update-user.php">
                <input type="text" name="name" readonly
                    value="<?= $user_current['name'] . " " . $user_current['lastname'] ?>">
                <input type="email" name="email" readonly value="<?= $user_current['email'] ?>">
            </form>
        </div>
        <div class="appointments">
            <pre>Добро пожаловать, <?= $name ?></pre>
            <h2>ЗАПИСИ МАСТЕРА</h2>
            <?php if (count($appls) != 0) {
                foreach ($appls as $appl) { ?>
                    <div class="appointment">
                        <div class="details">
                            <p>Услуга: <?= $appl[3] ?></p>
                            <p>Клиент: <?= $appl[9] . " " . $appl[10] ?></p>
                            <p>Дата: <?= $appl[1] ?></p>
                            <p>Время: <?= $appl[2] ?></p>
                            <p>Прибыль: <?= $appl[4] ?></p>
                            <p>Статус: <?= $status[$appl[8]]?></p>

                        </div>
                        <div class="appointment-actions">
                        <a href="../database\admin\confirm-db.php?id=<?= $appl[0] ?>"><button>подтвердить</button></a>
                        <a href="../database\admin\reject-db.php?id=<?= $appl[0] ?>"><button>отклонить</button></a>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="details_no">
                    <p>Записей пока нет!</p>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
include "../footer.php";
?>