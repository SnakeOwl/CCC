<?php
include_once 'head.php';
include_once 'header.php';
if (isset($_COOKIE['Login'])) {
    $Profile = getPeopleByID($_COOKIE['ID']);

    $data = $Profile->fetch_array(MYSQLI_ASSOC);
    if ($_COOKIE['password'] != $data['Password'])
        $a = 'he';
 //       header ("Location: http://www.google.com");
}
?>
    <main class="container">
        <h2 id="warning"></h2>
        <?php
    if (isset($_GET['edit'])) {
        ?>
            <form action="event.php" method="post">
                <h3>введите все новые параметры</h3>
                <input type="text" name="name" placeholder="Введите новое имя" required> <br>
                <input type="number" name="number" max="3759999999999" placeholder="новый телефон" value="375" required> <br>
                <input type="hidden" name="id" value="<?= $_COOKIE['ID'] ?>" required>
                <input type="text" name="password" placeholder="Введите новый пароль" required> <br>
                <input type="submit" name="editPeople" class="bttn-bordered bttn-md bttn-primary" value="изменить">

            </form>
            <?php
    }
    ?>

                <span>Пользователь: <?= $data['NamePerson'] ?> </span><br>
                <span>Телефон: <?= $data['Phone'] ?></span><br>
                <span>Баланс: <?= $data['balance'] ?></span><br>

                <a href="Profile.php?edit=true" class="editPpl">изменить данные</a><br><br>
<button id="getMoney" class="bttn-slant bttn-md bttn-success">пополнить счет</button> <br><br>
                <span>Заказы:</span><br>
                <div class="orders">
                    <table class="table table-striped table-bordered table-hover">
                       <thead class="thead-dark">
                           <tr>
                            <th>наименование заказа</th>
                            <th>дата заказа</th>
                            <th>цена</th>
                            <th>статус заказа</th>
                        </tr>
                       </thead>
                        
                        <?php
    $orders = getOrderByIDP($data['IDPerson']);
    if (isset($orders)) {

        while ($order = $orders->fetch_array(MYSQLI_ASSOC)) {
            //вычисление цены товара со скидкой
            $price = $order['Cell'];
            echo "
      <tr>
<td>{$order['ID']}</td>
<td>{$order['DateZak']}</td>
<td>$price</td>
<td title='ожидайте, когда наши операторы увидят заказ, то статус поменяется'>{$order['OrderStatus']}</td>      
</tr>
          ";
        }
    }
    ?>
                    </table>
                </div>
                
    </main>
    <script>
        $('#getMoney').on('click', function() {
            $.post('./event.php', {
                "getMoney": '1000',
                "ID": '<?=$data['IDPerson']?>'
            }, function() {
                $('#warning').text('Перезагрузите страницу')
            })
        })

    </script>
    <?php
include_once 'footer.html';
echo '</body></html>';
?>
