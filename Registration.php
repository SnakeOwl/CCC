<?php
include_once 'head.php';
include_once 'header.php';
?>
    <main class="container">
        <div class="registr">
            <h4>Регистрация</h4>

            <form action="event.php" method="post">
                Придумайте уникальные Имя и Пароль (не менее 7 символов) <br>
                <input type="text" name="name" minlength="7" placeholder="Введите имя" required> <br> Номер телефона: <br>
                <input type="number" name="number" placeholder="телефон" value="375" required> <br> Мы подготовили специально для вас 3 пароля на выбор: <br>

                <?php
        $pass= randomPassword();
        
        echo "$pass[0] <br>"
                . "$pass[1] <br>"
                . "$pass[2] <br>";
        
        ?>

                    <input type="text" name="password" minlength="7" placeholder="Введите пароль" required> <br>
                    <input type="submit" name="newPeople" class="bttn-bordered bttn-md bttn-primary" value="Регистрация">

            </form>
        </div>

        <br>
        <div class="inner">

            <h4>Вход</h4>
            <form action="event.php" method="post">
                <input type="text" name="name" placeholder="Введите имя" required> <br>
                <input type="text" name="password" placeholder="Введите пароль" required> <br>
                <input type="submit" class="bttn-bordered bttn-md bttn-primary" name="Login" value="Вход"> <br>
            </form>
        </div>
    </main>
    <?php
include_once 'footer.html';
echo '</body></html>';
?>
