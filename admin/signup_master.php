<?php
include "../header.php";

$con = mysqli_connect("localhost", "root", "", "theLADKA");

$query = mysqli_fetch_all(mysqli_query($con,"select * from category")) ;
?>
<section class="registr">
    <div class="registration-container">
        <div class="image-side">
            <img src="../img\cover\22.jpg" alt="Fashion Model">
        </div>
        <div class="form-side">
            <pre>РЕГИСТРАЦИЯ МАСТЕРА</pre>
            <h3>Введите данные</h3>
            <form action="..\database\admin\signup_master-db.php" method="POST" enctype="multipart/form-data">
                <input type="text" id="name" name="name" placeholder="Введите имя" required>
                
                <input type="text" id="last-name" name="lastname" placeholder="Введите фамилию" required>

                <input type="file" id="photo" name="photo" placeholder="Добавьте фотографию" required>

                <select class="id_category" name="id_category" id="id_category">
                <?php 
                    foreach ($query as $specil) { ?>
                        <option value="<?=$specil[0]?>"><?=$specil[1]?></option>
                    <?php } ?>
                </select>
                
                <input type="email" id="email" name="email" placeholder="Введите Email" required>
                
                <input type="password" id="password" name="password" placeholder="Введите пароль" required>

                <button type="submit">Зарегистрировать</button>
            </form>
        </div>
    </div>
</section>
<?php
include "../footer.php";
?>
