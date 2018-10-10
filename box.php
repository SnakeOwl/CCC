<?php
include_once 'head.php';
include_once 'header.php';
?>
    <main>
        <?php
    $sum = 0;
    $rebates = getRebate();
    $rebat = $rebates->fetch_array(MYSQLI_ASSOC);

    foreach ($_COOKIE as $key => $val) {
        if ($val == 'box') {
            $name = decodeCooki($key);
            $tov = getTovar($name);
            $data = $tov->fetch_array(MYSQLI_ASSOC);
            $sum += $data['Cell'];
            echo "<div class='tov'>
                <form action='event.php' method='post'>
                
                <span><a href='./tovar.php?name={$data['Name']}'>{$data['Name']}</a></span> ,
              <span>Цена{$data['Cell']}</span> ,
                  <input type='hidden' name='name' value='{$data['Name']}'></input>
                  <input type='submit' name='delTov' class=\"bttn-minimal bttn-xs bttn-royal\" value='удалить из корзины'></input>
</form>
              </div>";
        }
    }
    $sum = (isset($rebat)) ? $sum - $sum / 100 * $rebat['Rebate'] : $sum;
    echo "<span> Общая цена товара: $sum</span>";
    ?>
            <br>
            <button class="pay bttn-fill bttn-md bttn-danger">Заказать</button>
    </main>

    <div class="backgroundPlata">
        <div class="Plata">
            <form action="event.php" method="post">
                <span class="h5">Выберите способ доставки:</span>
                <br>
                <input type="radio" name="radio" value="забрать из магазина">забрать из магазина (товар будет в магазине уже через 3-4 дня. Для того чтобы забрать товар нужно сказать что вы заказывали и свой ID (
                <?= $_COOKIE['ID'] ?>) у продавца)
                    <br> выберите адрес магазина:
                    <br>
                    <select name="City" value='true'>

                <?php
                $stores = getStores();
                while ($data = $stores->fetch_array(MYSQLI_ASSOC)) {
                    ?>
                    <option value="<?= $data['Addres'] ?>"><?= $data['Addres'] ?></option>
                <?php } ?>

            </select>

                    <br>
                    <input type="radio" name="radio" value="доставка курьером" checked>доставка курьером(нужно заплатить 5 р. при получении товара, доставка действует только в пределах РБ)
                    <br>
                    <input type="radio" name="radio" value="доствка почтой">доствка почтой
                    <br>
                    <input type="text" name="addr" placeholder="укажите адрес: Г.Гомель, ул.привокзальная 5. кв.34">
                    <br>
                    <input type="text" placeholder="почтовый индекс">
                    <br>
                    <input type="hidden" name="peopId" value=" <?= $_COOKIE['ID'] ?>">
                    <input type="hidden" name="pass" value=" <?= $_COOKIE['password'] ?>">

                    <?php
            foreach ($_COOKIE as $key => $val) {
                ?>

                        <?php
                if ($val == 'box') {
                    $name = decodeCooki($key);
                    ?>
                            <input type="hidden" name="nameTovar[]" value="<?= $name ?>">
                            <?php }
            }
            ?>
                            <span> Цена за всё:<?= $sum ?></span><br>
                            <input type="submit" name="ZAKAZ" id="ZAKAZ" class="pay bttn-fill bttn-md bttn-danger" value="заказать">

            </form>
            <button id="hidden" class="bttn-bordered bttn-md bttn-primary">закрыть</button>
        </div>
    </div>

    <script>
        $(".backgroundPlata").css('display', 'none')
        $('.pay').on('click', function() {
            $(".backgroundPlata").css('display', 'block');
        })

        $('#hidden').on('click', function() {
            $(".backgroundPlata").css('display', 'none');
        })

    </script>
    <?php
include_once 'footer.html';
echo '</body></html>';
?>
