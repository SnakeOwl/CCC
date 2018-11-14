<?php
include_once 'head.php';
include_once 'header.php';
include_once 'metods.php';
?>
<main class="container">
    <?php
    $tovar = getTovar($_GET['name']);
    $data = $tovar->fetch_array(MYSQLI_ASSOC)
    ?>
    <div class="imagesTovar">
        <?php
        $files = scandir("./Images/{$_GET['name']}/");
        for ($I = 2; $I < 6; $I++) {
            echo "<img src=\"Images/{$_GET['name']}/{$files[$I]}\" alt=\"errorImg\">";
        }
        ?>
    </div>
    <div class="mainImg" id="mainImg"></div>
    <h1>
        <?= $data['Name'] ?>
    </h1>
    Цена:<span class="priceTovar">
        <?= $data['Cell'] ?></span>
    <br>
    <button class="buy bttn-fill bttn-md bttn-danger buyTovar">Купить за 1 клик</button>
    <br>
    <button class="inBox bttn-minimal bttn-md bttn-warning" value="<?= $data['Name'] ?>">добавить в корзину</button>
    <br><br>
    <span class="description">
        <?= $data['Description'] ?></span>
    <br>
    <br>
    <h3>Характеристики</h3>
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-light">
            
        
            <td>Параметр</td>
            <td>Значение</td>
        </thead>
        <?php
        $param = getParameters($_GET['name']);
        while ($par = $param->fetch_array(MYSQLI_ASSOC)) {
            ?>
        <tr>
            <td>
                <?= $par['Parametr'] ?>
            </td>
            <td>
                <?= $par['Value'] ?>
            </td>
        </tr>
        <?php } ?>

        <tr>
            <td>Производитель</td>
            <td>
                <?= $data['Maker'] ?>
            </td>
        </tr>

        <tr>
            <td>Гарантия</td>
            <td>
                <?= $data['Garant'] ?>
            </td>
        </tr>

    </table>



    <a class="toInfo" href="infoAboutDelivery.php" target="_blank">Процесс получения товара можно осмотреть перейдя по ссылке</a>
    <div class="Rewievs">
        <?php
        $rewievs = getRewiev($_GET['name']);
        //переменная для ограничения отзывов (до 5)
        $I = 0;
        while ($rewiev = $rewievs->fetch_array(MYSQLI_ASSOC)) {
            if ($I == 5)
                break;
            ?>
        <div class="rewiev">
            <span>
                <?= $rewiev['Review'] ?></span>
            <sub>дата:
                <?= $rewiev['DateRev'] ?></sub>
        </div>
        <?php
                }
                if (isset($_COOKIE['Login']) & isset($_COOKIE['password'])) {
                    ?>
        <form action="event.php" method="post">
            <textarea name="reviev" placeholder="поделитесь своим мнениеом о данном товаре" required></textarea>
            <input type="hidden" name="nameTovar" value="<?=$_GET['name']?>">
            <br> Оцените товар:
            <img src="./Images/starR1.png" width="28" alt=""> <input type="range" step="1" min="1" max="5" name="reit" required><img src="./Images/starR5.png" width="32" alt="">
            <input class="bttn-bordered bttn-sm bttn-primary" type="submit" name="revie" value="отправить">

        </form>

        <?php } else{
            echo '<br> <span>войдите чтобы оставлять записи</span>';
        } ?>
    </div>
</main>
<script defer>
    $('.buy').on("click", function() {
        $('.back').css('display', 'block')
    })
    $('#mainImg').css('background-image', "url('" + $('.imagesTovar > img:first-child').attr('src') + "')")
    $('.imagesTovar > img').on('click', function() {
        var path = $(this).attr('src')
        $('#mainImg').css('background-image', "url('" + path + "')")
    })

    $('.inBox').on("click", function() {
        $.post("./event.php", {
            addTov: 'true',
            name: $(this).attr('value')
        })
    })

</script>

<?php
include './speedBuy.php';
include './footer.html';
echo '</body></html>';
$conn->close();
?>
