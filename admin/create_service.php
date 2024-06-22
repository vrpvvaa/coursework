<?php
include "../header.php";
require_once "../database\User.php";
require_once "../database\Application.php";

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


$add_service = new Application();
$getIdCategory = $add_service->getIdCategory();

?>

<div class="booking-header">
    <pre>Добро пожаловать, <?= $name ?></pre>
    <h1>Добавление услуги</h1>
</div>
<section class="booking">
    <div class="book">
        <form action="..\database\admin\addservice-db.php" class="form-container" method="post">
            <div class="form-left">
                <label for="name">Название услуги</label>
                <input type="text" id="text" name="name">

                <label for="sallary">Стоимость</label>
                <input type="text" id="sallary" name="sallary">

                <label for="id_category">Категория</label>
                <select id="id_category" name="id_category">
                    <?php if (count($getIdCategory) != 0) {
                        foreach ($getIdCategory as $cat) { ?>
                            <option value="<?= $cat[0] ?>"><?= $cat[1]?></option>
                        <?php }
                    } ?>
                </select>

                <label for="descr">Описание</label>
                <textarea type="text" id="descr" name="descr" rows="5" cols="40"></textarea>

                </div>

            <div class="form-right">
                <img src="..\img\master\311.png" alt="Мастер">
                <button class="btn" type="submit">Добавить</button>
            </div>
            </div>
        </form>
    </div>
</section>

<?php
include "../footer.php";
?>