<?php
include "../header.php";

require_once "..\database\User.php";

$services = new User;

$service = $services->getService();
$nailservice = $services->getNailService();
$makeupservice = $services->getMakeupService();

?>

<section class="service_adm">
    <div class="admin-panel">
        <h1>УСЛУГИ САЛОНА</h1>
        <div class="services_admin">
            <div class="service-column">
                <h2>НОГТЕВОЙ СЕРВИС</h2>
                <?php if (count($nailservice) != 0) {
                    foreach ($nailservice as $nail) { ?>
                        <div class="service-card">
                            <img src="..\img\icon\nails11.png" alt="Снятие макияжа">
                            <div class="service-details-adm">
                                <p><a href="../service_one.php?id=<?= $nail[0] ?>"><?= $nail[1] ?></a></p>
                                <div class="price_del">
                                    <span><?= $nail[2] ?> ₽</span>
                                    <a href="../database\admin\delete_service-db.php?id=<?= $nail[0] ?>"><button class="delete-button"><img src="..\img\icon\delete.png" alt="Удалить"></button></a>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
                <!-- <div class="service-card">
                    <img src="path/to/icon.png" alt="Снятие макияжа">
                    <div class="service-details">
                        <p>СНЯТИЕ МАКИЯЖА</p>
                        <span>900 ₽</span>
                        <button class="delete-button"><img src="path/to/trash-icon.png" alt="Удалить"></button>
                    </div>
                </div> -->
            </div>
            <div class="divider"></div>
            <div class="service-column">
                <h2>СТИЛИСТЫ ВИЗАЖИСТЫ</h2>
                <?php if (count($makeupservice) != 0) {
                    foreach ($makeupservice as $makeup) { ?>
                        <div class="service-card">
                            <img src="../img\icon\makeup11.png" alt="Снятие макияжа">
                            <div class="service-details-adm">
                                <p><a href="service_one.php?id=<?= $makeup[0] ?>"><?= $makeup[1] ?></a></p>
                                <div class="price_del">
                                    <span><?= $makeup[2] ?> ₽</span>
                                    <a href="../database\admin\delete_service-db.php?id=<?= $makeup[0] ?>"><button class="delete-button"><img src="..\img\icon\delete.png" alt="Удалить"></button></a>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
                <!-- <div class="service-card">
                    <img src="../img\icon\makeup11.png" alt="Снятие макияжа">
                    <div class="service-details">
                        <p>СНЯТИЕ МАКИЯЖА</p>
                        <span>900 ₽</span>
                        <button class="delete-button"><img src="path/to/trash-icon.png" alt="Удалить"></button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    </html>

</section>

</html>



<?php
include "../footer.php";
?>