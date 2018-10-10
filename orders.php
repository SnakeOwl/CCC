<?php
if (!isset($_COOKIE['ID']))
    if ($_COOKIE['ID'] == 12 || $_COOKIE['ID'] == 11) {
        $peoples = getPeopleByID($_COOKIE['ID']); 
                                $admin = $peoples->fetch_array(MYSQLI_ASSOC);
                                if ($_COOKIE['password'] != $admin['Password']){
                                    header("Location: index.php");
                                }
        $per = 'зашел админ или оператор';
    } else {
        unLog();
        header("Location: index.php");
    }
include_once 'head.php';
include_once 'header.php';
?>

    <main>
        <h2>Эта таблица показывает новые заказы, просто нажмите на кноку когда отправите заказ</h2>
        <table>
            <tr>
                <th></th>
                <th>товары</th>
                <th>дата заказа</th>
                <th>ИД человека</th>
                <th>счет</th>
                <th>статус</th>
            </tr>

            <?php
    $orders = getNewOrders();
    while ($order = $orders->fetch_array(MYSQLI_ASSOC)) {
        ?>
                <tr>
                    <td><a href="event.php?ID=<?=$order['ID']?>&IDP=<?=$order['IDPeople']?> ">отправка</a></td>
                    <td>
                        <?= $order['ID'] ?>
                    </td>
                    <td>
                        <?= $order['DateZak'] ?>
                    </td>
                    <td>
                        <?= $order['IDPeople'] ?>
                    </td>
                    <td>
                        <?= $order['Cell'] ?>
                    </td>
                    <td>
                        <?= $order['OrderStatus'] ?>
                    </td>
                </tr>


                <?php } ?>
        </table>


    </main>

    <?php
include_once 'footer.html';
echo '</body></html>';
