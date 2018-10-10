<?php
include_once 'event.php';
if ($_COOKIE['ID'] == 12) {
    header("Location: orders.php");
}

if (isset($_COOKIE['ID'])) {
    if ($_COOKIE['ID'] == 11) {
        $peoples = getPeopleByID($_COOKIE['ID']);
        $admin = $peoples->fetch_array(MYSQLI_ASSOC);
        if ($_COOKIE['password'] != $admin['Password']) {
            header("Location: index.php");
        }
    }
}
include_once 'head.php';
include_once 'header.php';
?>
    <main>
        <a href="orders.php">перейти на страницу с заказами</a>
        <br>
        <br>

        <form action="event.php" method="post" enctype="multipart/form-data" class="panel">
            <div class="forms">
                <div class="form">
                    <p>создание записи товара</p>
                    <input type="text" name="nameTovar" placeholder="наименование товара" required><br>
                    <textarea name="description" cols="30" rows="10" placeholder="описание товара" title="можно не указывать"></textarea><br>
                    <input type="number" min="1" name="Price" placeholder="Цена" required><br>
                    <input type="text" name="type" placeholder="тип товара" title="вводить тип товара(ввод)-вид (мышь).
                       ввод-мышь, ввод-клавиатура, ввод-камера, ввод-геймпад, ввод-руль
                       вывод-наушники, вывод-монитор, вывод-колонки
                       другое-коврик, другое-накопитель, другое-зарядка" required><br>
                    <input type="text" name="maker" placeholder="производитель" title="производитель устройства" required><br>
                    <input type="number" name="garant" placeholder="гарантия в годах" title='можно не указать'>
                </div>
                <div class="form" title="все картинки должны быть разные по названию, в списке товаров видна та картинка, которая лежит первой в папке">
                    <div class="loadImg" title="на странице товаров будет видна картинка первая картинка">
                        загрузка изображений: <br>
                        <input type="file" name="img1" required><br>
                        <input type="file" name="img2" required><br>
                        <input type="file" name="img3" required><br>
                        <input type="file" name="img4" required><br>
                    </div>
                </div>
                <div class="form">
                    <p>задание параметров товара</p>
                    <textarea name="parameter" cols="30" rows="10" placeholder="параметр;значение;" title="вводить параметры по шаблону (параметр;значение;)" required></textarea><br>
                </div>
            </div>
            <input type="submit" value="Принять" name="Tovar">
        </form>
        <hr>

        <div class="forms">
            <div class="form">
                <form action="event.php" method="post">
                    <p>скидки на все товары</p>
                    <input type="number" name="rebate" placeholder="скидка%" title="размер скидки в процентах"><br>
                    <p>действующие скидки:</p>
                    <?php
                $rebates = getRebate();
                while ($rebate = $rebates->fetch_array(MYSQLI_ASSOC))
                    echo "<p> {$rebate['Rebate']} </p>"
                    ?>

                        <input type='submit' name='rebat' value='дать скидку'>
                </form>
                <form action="event.php" method="post">
                    <input type='submit' name='deleteRebate' value='удалить скидки'>
                </form>
            </div>
            <div class="form">
                <!-- создание записи магазина -->
                <form action="event.php" method="post" class="panel">
                    <p>создание магазина</p>
                    <input type="text" name='nameStore' placeholder="наименование магазина"><br>
                    <input type="text" name="addr" placeholder="адресс магазина"><br>
                    <input type="text" name="grafik" placeholder="график работы" title="указывать форматом: '8.00 - 20.00'"><br>
                    <input type="submit" name="magasine" value="Принять">
                </form>
            </div>

            <div class="form">
                <p>форма для создания людей</p>
                <form action="event.php" method="post" class="panel">
                    <input type="text" name="name" placeholder="Имя человека" required><br>
                    <input type="number" name="balance" placeholder="баланс" title="Есть возможность создавать своих людей с балансом. Можно использовать такие аккаунты для раздачи как акция." required><br>
                    <input type="text" name="password" placeholder="пароль" required><br>
                    <input type="submit" name="people" value="Принять">
                </form>
            </div>
        </div>
        <hr>
        <?php
    if (isset($_GET['edit'])) {
        ?>
            <div class="editing">
                <form action="event.php" method="post" class="pane2">
                    <div class="forms">

                        <?php
                    foreach ($_GET['edit'] as $key => $val) {
                        $arrayOne = [];
                        $arrayTwo = [];
                        $tovars = getTovar($val);
                        $tovar = $tovars->fetch_array(MYSQLI_ASSOC);

                        $parameters = getParameters($val);
                        while ($param = $parameters->fetch_array(MYSQLI_ASSOC)) {
                            $arrayOne[] = $param['Parametr'];
                            $arrayTwo[] = $param['Value'];
                        }
                        $arrayTree = array_merge($arrayOne, $arrayTwo);
                        $par = implode(';', $arrayTree);
                        ?>
                            <div class="form">
                                <p>изменение записи товара</p>
                                <input type="hidden" name="firstName[]" value="<?= $tovar['Name'] ?>">
                                <input type="text" name="nameTovar[]"  value="<?= $tovar['Name'] ?>" required><br>
                                <textarea name="description[]" cols="30" rows="10" title="можно не указывать"><?= $tovar['Description'] ?></textarea><br>
                                <input type="number" min="1" name="Price[]" value="<?= $tovar['Cell'] ?>" required><br>
                                <input type="text" name="type[]" value="<?= $tovar['Type'] ?>" title="вводить тип товара(ввод)-вид (мышь).
                                   ввод-мышь, ввод-клавиатура, ввод-камера, ввод-геймпад, ввод-руль
                                   вывод-наушники, вывод-монитор, вывод-колонки
                                   другое-коврик, другое-накопитель, другое-зарядка" required><br>
                                <input type="text" name="maker[]" value="<?= $tovar['Maker'] ?>" required><br>
                                <input type="number" name="garant[]" value="<?= $tovar['Garant'] ?>">
                            </div>
                            <div class="form">
                                <p>задание параметров товара</p>
                                <textarea name="parameter[]" cols="30" rows="10" required><?= $par ?></textarea><br>
                            </div>
                            <?php } ?>
                    </div>
                    <input type="submit" value="Принять" name="TovarEdd">
                </form>
            </div>
            <?php } ?>

            <div class="formatter">
                редактирование товаров
                <form action="event.php" method="post">
                    <table>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Наименование</td>
                            <td>Цена</td>
                            <td>Тип</td>
                            <td>Производитель</td>
                            <td>Гарантия(год)</td>
                        </tr>
                        <?php
                $tovars = getTovars();
                while ($tovar = $tovars->fetch_array(MYSQLI_ASSOC)) {
                    ?>
                            <tr>
                                <td><input type="checkbox" name="nameTovar[]" value="<?= $tovar['Name'] ?>"></td>
                                <td><a href="event.php?del=<?= $tovar['Name'] ?>&admin=scorpion">удалить</a></td>
                                <td><a href="event.php?edd=<?= $tovar['Name'] ?>&admin=scorpion">изменить</a></td>
                                <td>
                                    <?= $tovar['Name'] ?>
                                </td>
                                <td>
                                    <?= $tovar['Cell'] ?>
                                </td>
                                <td>
                                    <?= $tovar['Type'] ?>
                                </td>
                                <td>
                                    <?= $tovar['Maker'] ?>
                                </td>
                                <td>
                                    <?= $tovar['Garant'] ?>
                                </td>
                            </tr>
                            <?php } ?>

                    </table>
                    <input type="submit" name="allDel" value="удалить">
                    <input type="submit" name="allEdd" value="изменить">

                </form>

            </div>



    </main>
    <?php
include_once 'footer.html';
echo '</body></html>';
?>
