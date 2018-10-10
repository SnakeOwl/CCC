<?php
include_once './metods.php';
?>
    <main>
        <!-- фильтровать можно по оценкам, типу товара, производителю, цене -->
        <div class="filter">
            <span>Выводить товары:</span>
            <select name="type" id="type">
                <option value="all">все товары</option>
                <option value="input"
                <?php
                if (@$_GET['filter'] == 'ввод')
                    echo "selected='selected'"
                    ?>
                        >устройства ввода</option>
                <option value="output" 
                <?php
                if (@$_GET['filter'] == 'вывод')
                    echo "selected='selected'"
                    ?>
                        >устройства вывода</option>
                <option value="other"
                <?php
                if (@$_GET['filter'] == 'другое')
                    echo "selected='selected'"
                    ?>
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
                <option value="<?= $data['Maker'] ?>" 
                <?php
                if (isset($_GET['Maker'])) {
                    if ($data['Maker'] == $_GET['Maker'])
                        echo 'selected="selected"';
                }
                ?>   ><?= $data['Maker'] ?></option>
                    <?php } ?>
        </select>

            <div id="wowslider-container1">
                <div class="ws_images">
                    <ul>
                        <li><img src="data1/images/3e39434347c697a68b95e99c083ef02c.png" alt="Razer NAGA TRYNITY" title="Razer NAGA TRYNITY" id="wows1_0" /></li>
                        <li><img src="data1/images/53a2d4f0fd48b6200cb0e8ab63e5ef14.png" alt="Настраиваемая боковая панель" title="Настраиваемая боковая панель" id="wows1_1" /></li>
                        <li><img src="data1/images/76f127cb24e1005d0872db0920a8b64b.png" alt="На выбор 3 сменные боковые панели" title="На выбор 3 сменные боковые панели" id="wows1_2" /></li>
                        <li><img src="data1/images/909c2d0163a80937a27cd39683377ab4.png" alt="Оптический сенсор 5G с реальным разрешением 16 000 DPI
                             " title="Оптический сенсор 5G с реальным разрешением 16 000 DPI
                             " id="wows1_3" /></li>
                        <li><img src="data1/images/bf6209eca4815c8e3f19a0867b09f577.png" alt="Steelseries Rival 600" title="Steelseries Rival 600" id="wows1_4" /></li>
                        <li><a href="http://wowslider.net" target="_self"><img src="data1/images/886aa0ca4a73436b99e677447f4013bc.png" alt="jquery slideshow" title="Настраиваемый вес за счет грузиков" id="wows1_5"/></a></li>
                        <li><img src="data1/images/d42677217271ad4d53e5f3865903497e.png" alt="Разрешение оптического сенсора 12000 CPI" title="Разрешение оптического сенсора 12000 CPI" id="wows1_6" /></li>
                    </ul>
                </div>
                <div class="ws_bullets">
                    <div>
                        <a href="#" title="Razer NAGA TRYNITY"><span><img src="data1/tooltips/3e39434347c697a68b95e99c083ef02c.png" alt="Razer NAGA TRYNITY"/>1</span></a>
                        <a href="#" title="Настраиваемая боковая панель"><span><img src="data1/tooltips/53a2d4f0fd48b6200cb0e8ab63e5ef14.png" alt="Настраиваемая боковая панель"/>2</span></a>
                        <a href="#" title="На выбор 3 сменные боковые панели"><span><img src="data1/tooltips/76f127cb24e1005d0872db0920a8b64b.png" alt="На выбор 3 сменные боковые панели"/>3</span></a>
                        <a href="#" title="Оптический сенсор 5G с реальным разрешением 16 000 DPI
                       "><span><img src="data1/tooltips/909c2d0163a80937a27cd39683377ab4.png" alt="Оптический сенсор 5G с реальным разрешением 16 000 DPI
                                 "/>4</span></a>
                        <a href="#" title="Steelseries Rival 600"><span><img src="data1/tooltips/bf6209eca4815c8e3f19a0867b09f577.png" alt="Steelseries Rival 600"/>5</span></a>
                        <a href="#" title="Настраиваемый вес за счет грузиков"><span><img src="data1/tooltips/886aa0ca4a73436b99e677447f4013bc.png" alt="Настраиваемый вес за счет грузиков"/>6</span></a>
                        <a href="#" title="Разрешение оптического сенсора 12000 CPI"><span><img src="data1/tooltips/d42677217271ad4d53e5f3865903497e.png" alt="Разрешение оптического сенсора 12000 CPI"/>7</span></a>
                    </div>
                </div>
                <div class="ws_shadow"></div>
            </div>
            <script type="text/javascript" src="engine1/wowslider.js"></script>
            <script type="text/javascript" src="engine1/script.js"></script>
        </div>
        <div class="typ">
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

        <div class="tovars">

            <?php
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

                        <span class="reit"><?php printf("%.1f", $rait); ?></span>

                        <?php
//цена со скидкой или без
                    $cell = $data['Cell'];
                    $rebates = getRebate();
                    $rebat = $rebates->fetch_array(MYSQLI_ASSOC);
                    if (isset($rebat)) {
                        $cell = $cell - $cell / 100 * $rebat['Rebate'];
                    }
                    ?>

                            <span class="price"><?= $cell ?> р.</span>
                            <input type="hidden" class="typ" value="<?= $data['Type'] ?>">

                            <button class="buy bttn-bordered bttn-sm bttn-danger">Купить в 1 клик</button>

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
                    /*$('.tovar .text input[type="hidden"][value="ввод-мышь"]').parent().parent().show(400);
                    $('.tovar .text input[type="hidden"][value!="ввод-мышь"]').parent().parent().hide(400);
                    $('.tovar .text input[type="hidden"][value="ввод-мышь"]').parent().show(100);*/
                    break;

                case ("камера"):
                    window.location = "./index.php?filter=камера";

                    /*$('.tovar .text input[type="hidden"][value="ввод-камера"]').parent().parent().show(400);
                    $('.tovar .text input[type="hidden"][value!="ввод-камера"]').parent().parent().hide(400);
                    $('.tovar .text input[type="hidden"][value="ввод-камера"]').parent().show(100);*/
                    break;

                case ("клавиатура"):
                    window.location = "./index.php?filter=клавиатура";
                    /*
                    $('.tovar .text input[type="hidden"][value="ввод-клавиатура"]').parent().parent().show(500);
                    $('.tovar .text input[type="hidden"][value!="ввод-клавиатура"]').parent().parent().hide(500);
                    $('.tovar .text input[type="hidden"][value="ввод-клавиатура"]').parent().show(100);*/
                    break;
                case ("геймпад"):
                    window.location = "./index.php?filter=геймпад";
                    /*
                    $('.tovar .text input[type="hidden"][value="ввод-геймпад"]').parent().parent().show(500);
                    $('.tovar .text input[type="hidden"][value!="ввод-геймпад"]').parent().parent().hide(500);
                    $('.tovar .text input[type="hidden"][value="ввод-геймпад"]').parent().show(100);*/
                    break;
                case ("руль"):
                    window.location = "./index.php?filter=руль";
                    /*
                    $('.tovar .text input[type="hidden"][value="ввод-руль"]').parent().parent().show(500);
                    $('.tovar .text input[type="hidden"][value!="ввод-руль"]').parent().parent().hide(500);
                    $('.tovar .text input[type="hidden"][value="ввод-руль"]').parent().show(100);*/
                    break;
                case ("монитор"):
                    window.location = "./index.php?filter=монитор";
                    /*
                    $('.tovar .text input[type="hidden"][value="вывод-монитор"]').parent().parent().show(500);
                    $('.tovar .text input[type="hidden"][value!="вывод-монитор"]').parent().parent().hide(500);
                    $('.tovar .text input[type="hidden"][value="вывод-монитор"]').parent().show(100);*/
                    break;
                case ("колонки"):
                    window.location = "./index.php?filter=колонки";
                    /*
                    $('.tovar .text input[type="hidden"][value="вывод-колонки"]').parent().parent().show(500);
                    $('.tovar .text input[type="hidden"][value!="вывод-колонки"]').parent().parent().hide(500);
                    $('.tovar .text input[type="hidden"][value="вывод-колонки"]').parent().show(100);*/
                    break;
                case ("наушники"):
                    window.location = "./index.php?filter=наушники";
                    /*
                    $('.tovar .text input[type="hidden"][value="вывод-наушники"]').parent().parent().show(500);
                    $('.tovar .text input[type="hidden"][value!="вывод-наушники"]').parent().parent().hide(500);
                    $('.tovar .text input[type="hidden"][value="вывод-наушники"]').parent().show(100);*/
                    break;
                case ("коврики"):
                    window.location = "./index.php?filter=коврик";
                    /*
                    $('.tovar .text input[type="hidden"][value="другое-коврик"]').parent().parent().show(500);
                    $('.tovar .text input[type="hidden"][value!="другое-коврик"]').parent().parent().hide(500);
                    $('.tovar .text input[type="hidden"][value="другое-коврик"]').parent().show(100);*/
                    break;
                case ("внешний аккумулятор"):
                    window.location = "./index.php?filter=зарядка";
                    /*
                    $('.tovar .text input[type="hidden"][value="другое-зарядка"]').parent().parent().show(500);
                    $('.tovar .text input[type="hidden"][value!="другое-зарядка"]').parent().parent().hide(500);
                    $('.tovar .text input[type="hidden"][value="другое-зарядка"]').parent().show(100);*/
                    break;
                case ("накопители"):
                    window.location = "./index.php?filter=накопитель";
                    /*
                    $('.tovar .text input[type="hidden"][value="другое-накопитель"]').parent().parent().show(500);
                    $('.tovar .text input[type="hidden"][value!="другое-накопитель"]').parent().parent().hide(500);
                    $('.tovar .text input[type="hidden"][value="другое-накопитель"]').parent().show(100);*/
                    break;
            }
        })

    </script>
