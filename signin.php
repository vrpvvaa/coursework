<?php
include "header.php";
?>
<section class="registr">
    <div class="auth-container">
        <div class="image-side">
            <img src="img\other\661.png" alt="Fashion Model">
        </div>
        <div class="form-side">
            <pre>Вход</pre>
            <h3>Введите данные</h3>
            <form action="database\signin-db.php" method="POST">  
                <input type="email" id="email" name="email" placeholder="Введите Email" required>
                
                <input type="password" id="password" name="password" placeholder="Введите пароль" required>

                <button type="submit">Войти</button>
            </form>

            <!-- кнопка не в форме -->
        </div>
    </div>
</section>
<?php
include "footer.php";
?>