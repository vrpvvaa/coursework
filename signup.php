<?php
include "header.php";
?>
<section class="registr">
    <div class="registration-container">
        <div class="image-side">
            <img src="img\cover\61.png" alt="Fashion Model">
        </div>
        <div class="form-side">
            <pre>РЕГИСТРАЦИЯ</pre>
            <h3>Введите данные</h3>
            <form action="database\signup-db.php" method="POST">
                <input type="text" id="name" name="name" placeholder="Введите имя" required>
                
                <input type="text" id="last-name" name="lastname" placeholder="Введите фамилию" required>
                
                <input type="email" id="email" name="email" placeholder="Введите Email" required>
                
                <input type="password" id="password" name="password" placeholder="Введите пароль" required>

                <button type="submit">Зарегистрироваться</button>
</form>
            <!-- кнопка не в форме -->
        </div>
    </div>
</section>
<?php
include "footer.php";
?>