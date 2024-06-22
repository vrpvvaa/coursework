<?php
include "header.php";
require_once "database\User.php";

$master = new User();

$nailPage = isset($_GET['nail_page']) ? (int)$_GET['nail_page'] : 1;
$makeupPage = isset($_GET['makeup_page']) ? (int)$_GET['makeup_page'] : 1;

$limit = 3;
$nailOffset = ($nailPage - 1) * $limit;
$makeupOffset = ($makeupPage - 1) * $limit;

$nailmasters = $master->getNailMastersWithPagination($limit, $nailOffset);
$totalNailMasters = $master->getTotalNailMasters();
$totalNailPages = ceil($totalNailMasters / $limit);

$Makeupmasters = $master->getMakeupMastersWithPagination($limit, $makeupOffset);
$totalMakeupMasters = $master->getTotalMakeupMasters();
$totalMakeupPages = ceil($totalMakeupMasters / $limit);
?>

<section class="hero">
    <img src="img\cover\div.swiper-slide-bg.png" alt="Salon Image">
    <div class="hero-text">
        <h1>Салон красоты премиум класса</h1>
        <p>В нашем салоне работают команды специалистов, которые являются экспертами в своей области и имеют
            отличную репутацию не только в стране, но и за ее пределами.</p>
        <button>Перейти к услугам</button>
    </div>
</section>

<section class="services">
    <div class="service">
        <img src="img\icon\nails1.png" alt="Ногтевой сервис">
        <h2>Ногтевой сервис</h2>
        <p>Профессиональный маникюр, педикюр и наращивание ногтей.</p>
    </div>
    <div class="service">
        <img src="img\icon\cosmetics1.png" alt="Макияж">
        <h2>Макияж</h2>
        <p>Профессиональные косметические средства и инструменты.</p>
    </div>
</section>

<!-- Nail Service Price List -->

<section class="price-list">
    <div class="hero">
        <img src="img\other\nail31.png" alt="Фон">
        <div class="hero-text">
            <pre>наши мастера</pre>
            <h1>НОГТЕВОГО СЕРВИСА</h1>
        </div>
    </div>
    <div class="masters-gallery">
        <?php if (count($nailmasters) != 0) {
            foreach ($nailmasters as $nail) { ?>
                <div class="master">
                    <img src=img\master\<?= $nail[7]?>>
                    <h3><?= $nail[2]." ". $nail[3]?></h3>
                    <p>топ мастер</p>
                    <a href="service.php" class="btn">К услугам</a>
                </div>
            <?php }
        } ?>
    </div>
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalNailPages; $i++) { ?>
            <a href="?nail_page=<?= $i ?>" class="<?= $i == $nailPage ? 'active' : '' ?>"><?= $i ?></a>
        <?php } ?>
    </div>
</section>

<section class="stylists">
    <section class="price-list">
        <div class="hero">
            <img src="img\other\nail3211.png" alt="Фон">
            <div class="hero-text">
                <pre>прайс-лист</pre>
                <h1>СТИЛИСТЫ ВИЗАЖИСТЫ</h1>
            </div>
        </div>
        <div class="masters-gallery">
        <?php if (count($Makeupmasters) != 0) {
            foreach ($Makeupmasters as $makeup) { ?>
                <div class="master">
                    <img src=img\master\<?= $makeup[7]?>>
                    <h3><?= $makeup[2]." ". $makeup[3]?></h3>
                    <p>топ мастер</p>
                    <a href="service.php" class="btn">К услугам</a>
                </div>
            <?php }
        } ?>
        </div>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalMakeupPages; $i++) { ?>
                <a href="?makeup_page=<?= $i ?>" class="<?= $i == $makeupPage ? 'active' : '' ?>"><?= $i ?></a>
            <?php } ?>
        </div>
    </section>
</section>

<?php
include "footer.php";
?>
