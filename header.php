<body>
    <header>
        <a href="index.php">
            <img src="Images/logo.png" alt="logo" class="logo">
        </a>
        <form action="./event.php">
            <input type="text" id="stringFind" name='f' <?php if (isset($_GET[ 'f'])) { if ($_GET[ 'f']=='not' ) echo " placeholder='не найдено'  style='box-shadow:0 0 0 1px red'"; } else { echo " placeholder='введите полное название товара'"; } ?> >
            <span class="Bfind"><img src="Images/search.png" height="24" alt=""></span>
        </form>
        <nav>
            <ul>
                <li><a href="index.php" title="на главную"><img src="Images/home.png" width="34" alt=""></a></li>
                <li><a href="stores.php" title="магазины"><img src="Images/stores.png" width="34" alt=""></a></li>
                <?php if (isset($_COOKIE['Login'])) { ?>

                <li><a href="Profile.php" title="профиль"><img src="Images/profile.png" width="34" alt=""></a></li>
                <li><a href="event.php?unLog='yes'" title="выход"><img src="Images/out.png" width="34" alt=""></a></li>
                <li><a href="box.php" title="корзина"><img src="Images/box.png" width="34" alt=""></a></li>

                <?php } else { ?>

                <li><a href="Registration.php" title="вход"><img src="Images/in.png" width="35" alt=""></a></li>
                <?php } ?>

                <li><a href="administration.php" title="Связь с администрацией"><img src="Images/info.png" width="34" alt=""></a></li>
                <?php if (isset($_COOKIE['Login']) && ($_COOKIE['ID'] == '11' || $_COOKIE['ID'] == 12 )) { ?>

                <li><a href="panel.php"><img src="Images/panel.png" width="34" alt=""></a></li>
                <?php } ?>
            </ul>
        </nav>
        <script>
            $('.Bfind').on('click', function() {
                window.location = "./event.php?f=" + document.getElementById('stringFind').value
            })

        </script>
    </header>
