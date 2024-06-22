<?php
include "header.php";

require_once "database\User.php";

session_start();
$check = isset($_SESSION["id_user"]) ? true : false;

if ($check) {
    $name = $_SESSION["name"];
}

$services = new User;

$service = $services->getService();
$nailservice = $services->getNailService();
$makeupservice = $services->getMakeupService();

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
            <pre>прайс-лист</pre>
            <h1>НОГТЕВОГО СЕРВИСА</h1>
        </div>
    </div>
    <div class="price-list-description">
        <p>Опытные мастера сделают качественный маникюр и педикюр, ухаживая за кожей и ногтями с использованием
            современных методик.</p>
    </div>
    <ul class="price-items">
        <?php if (count($nailservice) != 0) {
            foreach ($nailservice as $nail) { ?>
                <li>
                    <span class="img-text">
                        <img src="img\icon\nails11.png" alt="Иконка"><a
                            href="service_one.php?id=<?= $nail[0] ?>"><?= $nail[1] ?></a></span>
                    <?php if (!$check) { ?>
                        <a href="signup.php"><span class="price"><?= $nail[2] ?> ₽</span></a>
                    <?php } else { ?>
                        <a href="booking_nail.php?id=<?= $nail[0] ?>"><span class="price"><?= $nail[2] ?> ₽</span></a>
                    <?php } ?>
                </li>
            <?php }
        } ?>
    </ul>
</section>

<!-- Makeup Artists Price List -->
<section class="price-list">
    <div class="hero">
        <img src="img\other\nail3211.png" alt="Фон">
        <div class="hero-text">
            <pre>прайс-лист</pre>
            <h1>СТИЛИСТЫ ВИЗАЖИСТЫ</h1>
        </div>
    </div>
    <div class="price-list-description">
        <p>Наши визажисты создадут неповторимый образ для любого мероприятия, используя профессиональную косметику.</p>
    </div>
    <ul class="price-items">
        <?php if (count($makeupservice) != 0) {
            foreach ($makeupservice as $makeup) { ?>
                <li>
                    <span class="img-text">
                        <img src="img\icon\makeup11.png" alt="Иконка"><a
                            href="service_one.php?id=<?= $makeup[0] ?>"><?= $makeup[1] ?></a></span>
                            <?php if (!$check) { ?>
                        <a href="signup.php"><span class="price"><?= $makeup[2] ?> ₽</span></a>
                    <?php } else { ?>
                        <a href="booking_makeup.php?id=<?= $makeup[0] ?>"><span class="price"><?= $makeup[2] ?> ₽</span></a>
                    <?php } ?>
                </li>
            <?php }
        } ?>
    </ul>
</section>

<?php
include "footer.php";
?>