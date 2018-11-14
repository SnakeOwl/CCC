<?php
include_once 'head.php';
include_once 'header.php';
?>
    <main class="container">
        <?php
    if (isset($_GET['edit'])) {
        if ($_COOKIE['ID'] != 11) {
            unLog();
        } else {
            $editStode = getStoreByAddr($_GET['edit']);
            $store = $editStode->fetch_array(MYSQLI_ASSOC);
            ?>
            <form action="event.php" method="post" class="panel">
                <p>изменение магазина</p>
                <input type="hidden" name="firstaddr" value="<?=$store['Addres']?>">
                <input type="text" name='nameStore' value="<?=$store['Name']?>" placeholder="наименование магазина"><br>
                <input type="text" name="addr" value="<?=$store['Addres']?>" placeholder="адресс магазина"><br>
                <input type="text" name="grafik" value="<?=$store['Grafik']?>" placeholder="график работы" title="указывать форматом: '8.00 - 20.00'"><br>
                <input type="submit" name="editMagasine" value="Принять">
            </form>
            <?php
        }
    }
    ?>
                <h2>Наши магазины.</h2>
                    <table class="table table-striped table-bordered table-hover">
                       <thead class="thead-light">
                            <th>Название</th>
                            <th>Адрес</th>
                            <th>График работы</th>
                        </thead>
                        <?php
        $stores = getStores();
        while ($data = $stores->fetch_array(MYSQLI_ASSOC)) {
            ?>


                            <tr>
                                <td>
                                    <?= $data['Name'] ?>
                                </td>
                                <td>
                                    <?= $data['Addres'] ?>
                                </td>
                                <td>
                                    <?= $data['Grafik'] ?>
                                </td>
                                <?php
                if (isset($_COOKIE['ID'])) {
                            if ($_COOKIE['ID'] == 11){
                        $peoples = getPeopleByID($_COOKIE['ID']); 
                                $admin = $peoples->fetch_array(MYSQLI_ASSOC);
                                if ($_COOKIE['password'] == $admin['Password']){ 
                                ?>
                                    <td>
                                        <form action="event.php" method="post">
                                            <input type="hidden" name="addr" value="<?= $data['Addres'] ?>">
                                            <input type="submit" class="bttn-minimal bttn-sm bttn-success" name="delStore" value="удалить">
                                            <input type="submit" class="bttn-minimal bttn-sm bttn-success" name="editStore" value="изменить">
                                        </form>
                                    </td>
                                    <?php }}} ?>

                            </tr>
                            <?php } ?>
                    </table>


    </main>



    <?php
include_once 'footer.html';

echo '</body></html>';
$conn->close();
?>
