<?php
include "header.php";

$con = mysqli_connect("localhost", "root", "", "theLADKA");

$id_service = $_GET["id"];
$query = "SELECT * FROM `service` WHERE id_service = $id_service";
$sql = mysqli_fetch_assoc(mysqli_query($con, $query));
$img_nail = "img\other/nail3.jpg";
$img_make = "img\other/nail2.jpg";
$id_categ = $sql['id_category'];

?>
<section class="service_one-cont">
<div class="service-block">
    <div class="image-container">
        <?php if($id_categ == "1") {?>
        <img src="img\other\nail3.jpg" alt="Маникюр">
        <?php } else if($id_categ == "2"){?>
            <img src="img\other\make2.jpg" alt="Макияж">
            <?php } ?>
    </div>
    <div class="service-details">
    <?php if (count($sql) != 0) { ?>
        <pre>ПОДРОБНЕЕ ОБ УСЛУГЕ</pre>
        <h1><?=$sql['name_service']?></h1>
        <div class="service_descr">
        <p><?=$sql['descr']?></p>
        </div>
        <div class="price_one">
        ЦЕНА: <?=$sql['sallary']?> ₽
        </div>
        <?php }?>
    </div>
</div>
</section>
<?php
include "footer.php";
?>