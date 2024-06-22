<?php
include "header.php";
require_once "database\User.php";
require_once "database\Application.php";

$check = isset($_SESSION["id_user"]) ? true : false;

if ($check) {
    $name = $_SESSION["name"];
    $user = new User();
    $user_current = $user->selectDataUser($_SESSION["id_user"]);
}

if (isset($_SESSION["message"])) {
    $mes = $_SESSION["message"];
    echo "<script>alert('$mes')</script>";
    unset($_SESSION["message"]);
}

$con = mysqli_connect("localhost", "root", "", "theLADKA");


$book = new User;
$getNailMasters = $book->getNailMasters();
$getMakeupMasters = $book->getMakeupMasters();
$getService = $book->getService();

$id_ser = $_GET["id"];
$query = "SELECT * FROM `service` WHERE id_service = $id_ser";
$sql = mysqli_fetch_assoc(mysqli_query($con, $query));

?>

<div class="booking-header">
    <pre>Добро пожаловать, <?= $name ?></pre>
    <h1>ВАША БРОНЬ</h1>
</div>
<section class="booking">
    <div class="book">
        <form action="database\user\addbook-db.php" class="form-container" method="post">
            <div class="form-left">
                <label for="service">Услуга</label>
                <?php if (count($sql) != 0) { ?>
                    <input type="text" id="service" name="service" readonly value="<?= $sql['name_service'] ?>">
                    <input type="hidden" name="id_service" value="<?= $id_ser ?>">
                <?php }
                ?>

                <label for="master">Мастер</label>
                <select id="master" name="master">
                    <?php if (count($getNailMasters) != 0) {
                        foreach ($getNailMasters as $mast) { ?>
                            <option value="<?= $mast[0] ?>"><?= $mast[2] . " " . $mast[3] ?></option>
                        <?php }
                    } ?>
                </select>

                <label for="date">Дата записи</label>
                <input type="date" id="date" name="date">
                <label for="time">Время записи</label>
                <div class="time" id="time">
                    

                </div>

                <div class="total">
                    <?php if (count($sql) != 0) { ?>
                        ИТОГО: <span><?= $sql['sallary'] ?>Р</span>
                    <?php }
                    ?>
                </div>
            </div>
            <div class="form-right">
                <img src="img\master\311.png" alt="Мастер">
                <button class="btn" type="submit">Оформить</button>
            </div>
        </form>
    </div>
</section>
<script>

    $("#date").on("change", function (e) {
        $.ajax({
            url: "record_time.php",
            method: "POST",
            dataType: 'json',
            data: {
                "id_master": $("#master").val(), // Передаем выбранного мастера
                "date": $("#date").val()
            },
            success: function (free_time) {
                console.log(free_time);

                document.getElementById('time').innerHTML = "";
                for (i = 0; i < free_time.length; i++) {
                    $("#time").append(`
                    <input class="form-check-input" type="radio" onchange="check()" value="${free_time[i]}" name="time" id="${i}">
                    <label for="${i}" class="form-label">${free_time[i]}</label>
                `);
                }
            }
        });
    });

</script>

<?php
include "footer.php";
?>