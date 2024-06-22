<?php
include "../header.php";

require_once "../database/User.php";

$master = new User;

$nailmasters = $master->getNailMasters();
$Makeupmasters = $master->getMakeupMasters();

$status = [
    "Новая",
    "Принята",
    "Отклонена"
];
?>

<style>
    .admin-panel {
        max-width: 1500px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        font-size: 36px;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .services {
        display: flex;
        justify-content: space-between;
    }

    .service-column {
        width: 45%;
    }

    .divider {
        width: 2px;
        background-color: #ff3399;
        margin: 0 1%;
    }

    .master-card {
        background-color: #f2eceb;
        border-radius: 8px;
        padding: 20px;
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        justify-content: space-around;
    }

    .master-card img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-right: 20px;
    }

    .master-details {
        width: 100%;
    }

    .master-details p {
        margin: 5px 0;
    }

    .master-details button {
        display: block;
        margin-top: 10px;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        background-color: #d3cbc6;
        cursor: pointer;
    }

    .appointment-details {
        text-align: start;
        margin-right: 75px;
    }

    .master-details button:last-child {
        margin-top: 5px;
    }

    .appointment-action {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .appointment-action button {
        display: block;
        margin-top: 10px;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        background-color: #d3cbc6;
        cursor: pointer;
    }
</style>

<section class="nailservice">
    <div class="admin-panel">
        <h1>МАСТЕРА САЛОНА</h1>
        <div class="services">
            <div class="service-column">
                <h2>НОГТЕВОЙ СЕРВИС</h2>
                <?php if (count($nailmasters) != 0) {
                    foreach ($nailmasters as $nail) { ?>
                        <div class="master-card">
                            <div class="appointment-info">
                                <img src="../img/master/<?= $nail[7] ?>" alt="Фото мастера">
                                <div class="appointment-details">
                                    <p>Имя: <?= $nail[2] . " " . $nail[3] ?></p>
                                    <p>Категория: топ мастер</p>
                                    <p>Эл. почта: <?= $nail[4] ?></p>
                                </div>
                                <div class="appointment-action">
                                    <a href="book_master.php?id=<?= $nail[1] ?>"><button>история записей</button></a>
                                    <button class="delete-master" data-id="<?= $nail[1] ?>">удалить мастера</button>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
            <div class="divider"></div>
            <div class="service-column">
                <h2>СТИЛИСТЫ ВИЗАЖИСТЫ</h2>
                <?php if (count($Makeupmasters) != 0) {
                    foreach ($Makeupmasters as $make) { ?>
                        <div class="master-card">
                            <div class="appointment-info">
                                <img src="../img/master/<?= $make[7] ?>" alt="Фото мастера">
                                <div class="appointment-details">
                                    <p>Имя: <?= $make[2] . " " . $make[3] ?></p>
                                    <p>Категория: топ мастер</p>
                                    <p>Эл. почта: <?= $make[4] ?></p>
                                </div>
                                <div class="appointment-action">
                                    <a href="book_master.php?id=<?= $make[1] ?>"><button>история записей</button></a>
                                    <button class="delete-master" data-id="<?= $make[1] ?>">удалить мастера</button>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll(".delete-master");
    
    deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            const masterId = this.getAttribute("data-id");
            const confirmation = confirm("Вы уверены что хотите удалить мастера?");
            
            if (confirmation) {
                window.location.href = `../database/admin/delete_master-db.php?id=${masterId}`;
            }
        });
    });
});
</script>

<?php
include "../footer.php";
?>
