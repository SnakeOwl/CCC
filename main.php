<?php
include_once './metods.php';
?>
<main class='container'>
    <!-- фильтровать по типу товара, производителю -->
    <div class="container filter w-100">
        <div class="row d-flex">
            <span>Выводить товары:</span>
            <select name="type" id="type">
                <option value="all">все товары</option>
                <option value="input" <?php if (@$_GET['filter']=='ввод' ) echo "selected='selected'" ?>
                    >устройства ввода</option>
                <option value="output" <?php if (@$_GET['filter']=='вывод' ) echo "selected='selected'" ?>
                    >устройства вывода</option>
                <option value="other" <?php if (@$_GET['filter']=='другое' ) echo "selected='selected'" ?>
                    >другие</option>
            </select>
            <span>
                Выбрать производителя:
            </span>
            <select name="makers" id="maker">
                <?php
            if (isset($_GET['filter'])) {
                $maker = getMakers($_GET['filter']);
            } else {

                $maker = getMakers();
            }
            while ($data = $maker->fetch_array(MYSQLI_ASSOC)) {
                ?>
                <option value="<?= $data['Maker'] ?>" <?php if (isset($_GET['Maker'])) { if ($data['Maker']==$_GET['Maker']) echo 'selected="selected"' ; } ?> >
                    <?= $data['Maker'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="w-100"></div>
        <div class="row ">
            <div id="carouselka" class="carousel slide col-md-8 float-left d-md-block d-none" data-ride="carousel ">
                <ol class="carousel-indicators">
                    <li data-target="#carouselka" data-slide-to="0" class="bg-secondary active"></li>
                    <li data-target="#carouselka" data-slide-to="1" class='bg-secondary'></li>
                    <li data-target="#carouselka" data-slide-to="2" class='bg-secondary'></li>
                    <li data-target="#carouselka" data-slide-to="3" class='bg-secondary'></li>
                </ol>
                <div class="carousel-inner h-100">
                    <div class="carousel-item active">
                        <img src="Images/Razer%20Naga%20Trinity/53a2d4f0fd48b6200cb0e8ab63e5ef14.png" alt="error-img" class='d-block w-100 h-100'>
                        <div class="carousel-caption d-none d-md-block">
                            <a href="./tovar.php?name=Razer Naga Trinity" class='text-success btn btn-outline-success'>Razer Naga Trinity</a>
                            <p>Великолепный дизайн</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="Images/Razer%20Naga%20Trinity/3e39434347c697a68b95e99c083ef02c.png" alt="error-img" class='d-block w-100 h-100'>
                        <div class="carousel-caption d-none d-md-block">
                            <a href="./tovar.php?name=Razer Naga Trinity" class='text-success btn btn-outline-success'>Razer Naga Trinity</a>
                            <p></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="Images/Razer%20Naga%20Trinity/76f127cb24e1005d0872db0920a8b64b.png" alt="error-img" class='d-block w-100 h-100'>
                        <div class="carousel-caption d-none d-md-block">
                            <a href="./tovar.php?name=Razer Naga Trinity" class='text-success btn btn-outline-success'>Razer Naga Trinity</a>
                            <p></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="Images/Razer%20Naga%20Trinity/909c2d0163a80937a27cd39683377ab4.png" alt="error-img" class='d-block w-100 h-100'>
                        <div class="carousel-caption d-none d-md-block">
                            <a href="./tovar.php?name=Razer Naga Trinity" class='text-success btn btn-outline-success'>Razer Naga Trinity</a>
                            <p></p>
                        </div>
                    </div>
                </div>


                <a class="carousel-control-prev" href="#carouselka" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon border bg-secondary rounded" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselka" role="button" data-slide="next">
                    <span class="carousel-control-next-icon border bg-secondary rounded" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="typ col-md-4 float-right">
                <?php
        if (@$_GET['filter'] != 'другое' & @$_GET['filter'] != 'вывод') {
            ?>
                <ul id="input">
                    <li><button class="bttn-stretch bttn-md bttn-primary">мышь</button></li>
                    <li><button class="bttn-stretch bttn-md bttn-primary">клавиатура</button></li>
                    <li><button class="bttn-stretch bttn-md bttn-primary">геймпад</button></li>
                    <li><button class="bttn-stretch bttn-md bttn-primary">руль</button></li>
                    <li><button class="bttn-stretch bttn-md bttn-primary">камера</button></li>
                </ul>
                <?php
        }
        if (@$_GET['filter'] != 'ввод' & @$_GET['filter'] != 'другое') {
            ?>
                <ul id="output">
                    <li><button class="bttn-stretch bttn-md bttn-warning">монитор</button></li>
                    <li><button class="bttn-stretch bttn-md bttn-warning">колонки</button></li>
                    <li><button class="bttn-stretch bttn-md bttn-warning">наушники</button></li>
                </ul>
                <?php
        }
        if (@$_GET['filter'] != 'ввод' & @$_GET['filter'] != 'вывод') {
            ?>
                <ul id="alter">
                    <li><button class="bttn-stretch bttn-md bttn-royal">коврики</button></li>
                    <li><button class="bttn-stretch bttn-md bttn-royal">внешний аккумулятор</button></li>
                    <li><button class="bttn-stretch bttn-md bttn-royal">накопители</button></li>
                </ul>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="tovars w-100">

        <?php
        //фильтры
        if (isset($_GET['filter']) & isset($_GET['Maker'])) {
            $tov = getTovars($_GET['Maker'], $_GET['filter']);
            $count = getCount($_GET['Maker'], $_GET['filter']);
        } elseif (isset($_GET['filter'])) {
            $tov = getTovars('not', $_GET['filter']);
            $count = getCount('not', $_GET['filter']);
        } elseif (isset($_GET['Maker'])) {
            $tov = getTovars($_GET['Maker']);
            $count = getCount($_GET['Maker']);
        } else {
            $tov = getTovars();
            $count = getCount();
        }
        
        //переменная для постраничной навигации
        $counter = $count->fetch_array(MYSQLI_NUM);
        $peremotka = 0;
//если есть выбор страницы

        if (isset($_GET['page'])) {
            //если 2 страница то выводит с 16 записи, если третья то с 31
            $peremotka = (($_GET['page'] - 1) * 15);
        }

        $move = 0;
        while ($data = $tov->fetch_array(MYSQLI_ASSOC)) {
            //игнорить все записи до определенной выше (перемотка)
            if ($move < $peremotka) {
                $move++;
                continue;
            }

            $rait = sumReit($data['Name']);
            ?>

        <div class="tovar">
            <div class="image">
                <a href="./tovar.php?name=<?= $data['Name'] ?>" class="nameTovar">

                    <?php
                        $files = scandir("./Images/{$data['Name']}/");
                        echo "<img src=\"Images/{$data['Name']}/{$files[2]}\" alt=\"errorImg\">";
                        ?>

                </a>
            </div>
            <div class="text">
                <a href="./tovar.php?name=<?= $data['Name'] ?>" class="nameTovar">
                    <?= $data['Name'] ?>
                </a>

                <span class="reit">
                    <?php printf("%.1f", $rait); ?></span>

                <?php
//цена со скидкой или без
                    $cell = $data['Cell'];
                    $rebates = getRebate();
                    $rebat = $rebates->fetch_array(MYSQLI_ASSOC);
                    if (isset($rebat)) {
                        $cell = $cell - $cell / 100 * $rebat['Rebate'];
                    }
                    ?>

                <span class="price">
                    <?= $cell ?> р.</span>
                <input type="hidden" class="typ" value="<?= $data['Type'] ?>">

                <button class="buy bttn-bordered bttn-sm bttn-danger d-none d-md-block">Купить в 1 клик</button>

                <button class="inBox bttn-minimal bttn-xs bttn-primary" value="<?= $data['Name'] ?>" title="чтобы увидеть корзину нужно зайти под зарегестрированным аккаунтом">добавить в корзину</button>

                <?php 
                        
 if (isset($_COOKIE['ID'])) { if ($_COOKIE['ID'] == 11){ $peoples = getPeopleByID($_COOKIE['ID']); $admin = $peoples->fetch_array(MYSQLI_ASSOC); if ($_COOKIE['password'] == $admin['Password']){
                        ?>
                <form action="event.php" method="post" class="delet">
                    <input type="hidden" name="nameTovar" value="<?= $data['Name'] ?>">
                    <input type="submit" name="delet" class="bttn-minimal bttn-sm bttn-success" value="удалить">
                </form>
                <?php }   }
                            } ?>
            </div>

        </div>


        <?php
            $move++;
            //чекнуть на проверку 15 записи
            if ($move == ($peremotka + 15 )) {
                break;
            }
        }
        ?>
    </div>
    <br>
    <div class="pages">
        <?php
    $I = 2;
    if (isset($_GET['filter'])){
            $filter = $_GET['filter'];
                echo "<a href='./index.php?filter=$filter'>1</a>";

        } else {
                echo "<a href='./index.php'>1</a>";
}

    while ($counter[0] > 15) {
        $counter[0] -= 15;
        if (isset($_GET['filter'])){
            $filter = $_GET['filter'];
                echo "<a href='./index.php?page=$I&filter=$filter'>$I</a>";

        } else {
            echo "<a href='./index.php?page=$I'>$I</a>";
        }
        $I++;
    }
    ?>
    </div>
    <?php
    include_once './speedBuy.php';
    $conn->close();
    ?>
</main>
<script>
    $('.inBox').on("click", function() {
        $.post("./event.php", {
            addTov: 'true',
            name: $(this).attr('value')
        });
    })

    $('.buy').on("click", function() {
        $('.back').css('display', 'block')

    });

    //изменение типа устройств
    $('#type').change(function() {
        switch ($('#type').val()) {
            case ('all'):
                window.location = "./index.php"
                break;
            case ('input'):
                window.location = "./index.php?filter=ввод"
                break;
            case ('output'):
                window.location = "./index.php?filter=вывод"
                break;
            case ('other'):
                window.location = "./index.php?filter=другое"
                break;
        }
    });


    //изменение производителя
    $('#maker').change(function() {
        get = $(this).val()
        <?php if (isset($_GET['filter'])) { ?>
        window.location = "./index.php?filter=<?= $_GET['filter'] ?>&Maker=" + get <?php } else { ?>
        window.location = "./index.php?Maker=" + get <?php } ?>

    });


    $('.typ ul li button').on('click', function() {
        console.log($(this).text());
        switch ($(this).text()) {
            case ("мышь"):
                window.location = "./index.php?filter=мышь";
                break;

            case ("камера"):
                window.location = "./index.php?filter=камера";
                break;

            case ("клавиатура"):
                window.location = "./index.php?filter=клавиатура";
                break;
            case ("геймпад"):
                window.location = "./index.php?filter=геймпад";
                break;
            case ("руль"):
                window.location = "./index.php?filter=руль";
                break;
            case ("монитор"):
                window.location = "./index.php?filter=монитор";
                break;
            case ("колонки"):
                window.location = "./index.php?filter=колонки";
                break;
            case ("наушники"):
                window.location = "./index.php?filter=наушники";
                break;
            case ("коврики"):
                window.location = "./index.php?filter=коврик";
                break;
            case ("внешний аккумулятор"):
                window.location = "./index.php?filter=зарядка";
                break;
            case ("накопители"):
                window.location = "./index.php?filter=накопитель";
                break;
        }
    })

</script>
