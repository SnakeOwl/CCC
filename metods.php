<?php

$conn = new mysqli('localhost', 'id6732907_dati', 'dDNH5D)$7@XJ3eu1vZb7', 'id6732907_databa');
//$conn = new mysqli('localhost', 'root', '', 'diplom');
$conn->set_charset("utf8");

//проверка коннекта
if ($conn->connect_error) {
    printf("проблема с коннектом: %s\n", $conn->connect_error);
    exit();
}

if ($conn->ping()) {
    //printf("Соединение в порядке!");
} else {
    printf("Ошибка: %s\n", $conn->error);
}

//функции занесения в базу данных
function setTovar($Name, $Cell, $Type, $Maker, $Description = null, $Garant = null) {
    $Name = sanitizeString($Name);
    $Cell = sanitizeString($Cell);
    $Type = sanitizeString($Type);
    $Maker = sanitizeString($Maker);
    $Description = sanitizeString($Description);
    $Garant = sanitizeString($Garant);
    $result = $GLOBALS['conn']->query("INSERT INTO `ttovar` VALUES("
            . "'$Name','$Cell', '$Description', '$Type', '$Maker', '$Garant')");

    if (!$result)
        die($GLOBALS['conn']->error);
}

function setOrder($NameTovar, $Cell, $IDPeople = null, $Rebate = null, $OrderStatus = "ожидание") {
    $NameTovar = sanitizeString($NameTovar);
    $Cell = sanitizeString($Cell);
    $IDPeople = sanitizeString($IDPeople);
    $Rebate = sanitizeString($Rebate);

    $result = $GLOBALS['conn']->query("INSERT INTO `torders` VALUES("
            . "'$NameTovar', CURDATE() ,'$IDPeople', '$Cell', '$Rebate', '$OrderStatus')");

    if (!$result)
        die($GLOBALS['conn']->error);
}

function setParams($NameTovar, $Param, $Value) {
    $NameTovar = sanitizeString($NameTovar);
    $Param = sanitizeString($Param);
    $Value = sanitizeString($Value);

    $result = $GLOBALS['conn']->query("INSERT INTO `tparameters` VALUES("
            . "'$NameTovar','$Param', '$Value')");

    if (!$result)
        die($GLOBALS['conn']->error);
}

function setPeople($NamePerson, $balance, $password, $phone = null) {
    $NamePerson = sanitizeString($NamePerson);
    $balance = sanitizeString($balance);
    $password = sanitizeString($password);
    $phone = sanitizeString($phone);

    $result = $GLOBALS['conn']->query("INSERT INTO `tpeople`(`NamePerson`,`balance`,`Password`,`Phone`) "
            . "VALUES('$NamePerson', '$balance','$password','$phone')");

    if (!$result)
        die($GLOBALS['conn']->error);
}

function setRaiting($NameTovar, $mark) {
    $NameTovar = sanitizeString($NameTovar);
    $mark = sanitizeString($mark);

    $result = $GLOBALS['conn']->query("INSERT INTO `traiting` VALUES("
            . "'$NameTovar','$mark')");

    if (!$result)
        die($GLOBALS['conn']->error);
}

function setRebate($Rebate) {
    $Rebate = sanitizeString($Rebate);
    $result = $GLOBALS['conn']->query("INSERT INTO `trebate` VALUES($Rebate)");
    if (!$result)
        die($GLOBALS['conn']->error);
}

function setReview($NameTovar, $Review) {
    $NameTovar = sanitizeString($NameTovar);
    $Review = sanitizeString($Review);

    $result = $GLOBALS['conn']->query("INSERT INTO `treviews` VALUES("
            . "'$NameTovar','$Review',CURDATE())");

    if (!$result)
        die($GLOBALS['conn']->error);
}

function setStore($Name, $addres, $grafik) {
    $Name = sanitizeString($Name);
    $addres = sanitizeString($addres);
    $grafik = sanitizeString($grafik);

    $result = $GLOBALS['conn']->query("INSERT INTO `tmagasines` VALUES("
            . "'$Name','$addres','$grafik')");

    if (!$result)
        die($GLOBALS['conn']->error);
}

//функции получения значений из базы
function getMakers($typeTovar = '3') {
    $typeTovar = sanitizeString($typeTovar);
    $result = $GLOBALS['conn']->query("SELECT DISTINCT Maker FROM `ttovar` "
            . "WHERE '$typeTovar' = 3 "
            . "OR `Type` LIKE '$typeTovar%' "
            . "OR `Type` LIKE '%$typeTovar'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

//функция получения товара с фильтрами
function getTovars($Maker = 'not', $type = '3', $typ = 'not') {
    $type = sanitizeString($type);
    $Maker = sanitizeString($Maker);
    if ($Maker == 'not') {
        $result = $GLOBALS['conn']->query(""
                . "SELECT * FROM `ttovar` "
                . "WHERE '$type' = 3 "
                . "OR `Type` LIKE '$type%'"
                . "OR `Type` LIKE '%$type'");
    } else {
        $result = $GLOBALS['conn']->query(""
                . "SELECT * FROM `ttovar` "
                . "WHERE `Maker` = '$Maker'"
                . "AND ('$type' = 3 "
                . "OR `Type` LIKE '$type%'"
                . "OR `Type` LIKE '%$type')");
    }


    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getTovar($NameTov) {
    $NameTov = sanitizeString($NameTov);

    $result = $GLOBALS['conn']->query("SELECT * FROM `ttovar` WHERE `Name` LIKE '%$NameTov%'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getStores() {
    $result = $GLOBALS['conn']->query("SELECT * FROM `tmagasines`");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getStoreByAddr($addr){
    $addr = sanitizeString($addr);
    $result = $GLOBALS['conn']->query("SELECT * FROM `tmagasines`"
            . "WHERE `Addres` = '$addr'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getOrders() {
    $result = $GLOBALS['conn']->query("SELECT * FROM `torders`");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getNewOrders() {
    $result = $GLOBALS['conn']->query("SELECT * FROM `torders`"
            . "WHERE `OrderStatus` <> 'отправлено'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getOrder($NameTovar) {
    $NameTovar = sanitizeString($NameTovar);

    $result = $GLOBALS['conn']->query("SELECT * FROM `torders` WHERE `ID` = '$NameTovar'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getParameters($nameTovar) {
    $nameTovar = sanitizeString($nameTovar);

    $result = $GLOBALS['conn']->query("SELECT * FROM `tparameters` WHERE `ID` = '$nameTovar'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getPeople($Name) {
    $Name = sanitizeString($Name);

    $result = $GLOBALS['conn']->query("SELECT * FROM `tpeople` WHERE `NamePerson` = '$Name'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

//функцция создана для проверки кук пользователя
function getPeopleByID($ID) {
    $ID = sanitizeString($ID);

    $result = $GLOBALS['conn']->query("SELECT * FROM `tpeople` WHERE `IDPerson` = '$ID'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getRaiting($NameTov) {
    $NameTov = sanitizeString($NameTov);

    $result = $GLOBALS['conn']->query("SELECT * FROM `traiting` WHERE `ID` = '$NameTov'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getRebate() {
    $result = $GLOBALS['conn']->query("SELECT * FROM `trebate`");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getRewiev($NameTov) {
    $NameTov = sanitizeString($NameTov);

    $result = $GLOBALS['conn']->query("SELECT * FROM `treviews` WHERE `ID` = '$NameTov'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function getOrderByIDP($IDpeople) {
    $IDpeople = sanitizeString($IDpeople);

    $result = $GLOBALS['conn']->query("SELECT * FROM `torders` WHERE `IDPeople` = '$IDpeople'");

    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

//используется для подсчета средней оценки товара
function sumReit($nameTovar) {
    $tov = getRaiting($nameTovar);
    $sum = 0;
    $count = 1;
    while ($data = $tov->fetch_array(MYSQLI_ASSOC)) {
        $sum += $data['mark'];
        $count++;
    }

    //чтобы деления на ноль не было
    $count = ($count == 1) ? 1 : --$count;
    $rait = $sum / $count;

    return (is_numeric($rait)) ? $rait : 0;
}

//используется для установки кук при регистрации и авторизации
function cooki($ID, $password) {
    setcookie('Login', 'true', time() + 60 * 60 * 24 * 30);
    setcookie('password', "$password", time() + 60 * 60 * 24 * 30);
    setcookie('ID', "$ID", time() + 60 * 60 * 24 * 30);
}

//функция в какой-то мере защищает от SQL иньекций
function sanitizeString($var) {
    if (!isset($var)) {
        return null;
    } else {
        global $conn;
        if (get_magic_quotes_gpc())
            $var = stripslashes($var);
        $var = htmlspecialchars($var);
        $var = strip_tags($var);
        return $var = $conn->real_escape_string($var);
    }
}

//эти функции используются для корзины товаров
function addTovar($nameTovar) {
    $nameTovar = codeCooki($nameTovar);
    setcookie($nameTovar, 'box', time() + 60 * 60 * 24 * 30);
}

//удаление товара из корзины
function delTovar($nameTovar) {
    $nameTovar = codeCooki($nameTovar);
    setcookie($nameTovar, 'box', time() - 60 * 60 * 24 * 30);
}

function unLog() {
    foreach ($_COOKIE as $key => $value)
        setcookie($key, $value, time() - 60 * 60 * 24 * 30);
    header("Location: ./index.php");
}

//эти две функции нужны чтобы установка кук не выдавало ошибок
function codeCooki($string) {
    $len = strlen($string);
    $string = str_replace(" ", "!", $string);
    $string = str_replace("'", ">", $string);
    $string = str_replace(",", "[", $string);
    return $string;
}

function decodeCooki($string) {
    $len = strlen($string);
    $string = str_replace("!", " ", $string);
    $string = str_replace(">", "'", $string);
    $string = str_replace("[", ",", $string);
    return $string;
}

//функция для открытия изображений
function getImages($nameTOvar) {
    $files = scandir("./Images/$nameTOvar/");
    print_r($files);
    $count = count($files);
    for ($I = 2; $I < $count; $I++)
        echo "<img scr='Images/$nameTOvar/{$files[$I]}' width='200'  alt='image'>";
}

function deleteRebates() {
    $result = $GLOBALS['conn']->query("DELETE FROM `trebate` WHERE 0 = 0");

    if (!$result)
        die($GLOBALS['conn']->error);
}

//удаление товара из базы
function deletTovar($nameTovar) {
    $nameTovar = sanitizeString($nameTovar);
    rmRec("./Images/$nameTovar");
    $result = $GLOBALS['conn']->query("DELETE FROM `ttovar` WHERE `Name` LIKE '%$nameTovar'");

    if (!$result)
        die($GLOBALS['conn']->error);
}

//функция рекурсивного удаления
function rmRec($path) {
    if (is_file($path))
        return unlink($path);
    if (is_dir($path)) {
        foreach (scandir($path) as $p)
            if (($p != '.') && ($p != '..'))
                rmRec($path . DIRECTORY_SEPARATOR . $p);
        return rmdir($path);
    }
    return false;
}

function UPDATEPeopleBalance($number, $IDPeople, $function = '+') {
    if ($function == '+') {
        $result = $GLOBALS['conn']->query("UPDATE `tpeople` "
                . "SET `balance` = `balance` + '$number' "
                . "WHERE `IDPerson` = '$IDPeople'");
    }
    if ($function == '-') {
        $result = $GLOBALS['conn']->query("UPDATE `tpeople` "
                . "SET `balance` = `balance` - '$number' "
                . "WHERE `IDPerson` = '$IDPeople'");
    }
    if (!$result)
        die($GLOBALS['conn']->error);
}

function UPDATETovar($Name, $Cell, $Description, $Type, $Maker, $FirstName, $Garant, $parameters) {

    $Name = sanitizeString($Name);
    $Cell = sanitizeString($Cell);
    $Description = sanitizeString($Description);
    $Type = sanitizeString($Type);
    $Maker = sanitizeString($Maker);
    $Garant = sanitizeString($Garant);

    $result = $GLOBALS['conn']->query("UPDATE `ttovar` "
            . "SET `Name` = '$Name',"
            . "`Cell` = '$Cell',"
            . "`Description` = '$Description',"
            . "`Type` = '$Type',"
            . "`Maker` = '$Maker',"
            . "`Garant` = '$Garant'"
            . "WHERE `Name` = '$FirstName'");

    if (!$result)
        die($GLOBALS['conn']->error);

    //очистка параметров товара
    $result = $GLOBALS['conn']->query("DELETE FROM `tparameters` "
            . "WHERE `ID` = '$FirstName'");
    if (!$result)
        die($GLOBALS['conn']->error);

    //внесение параметров
    $array = [];
    $array = explode(';', $parameters);
    for ($I = 0; $I < count($array); $I++) {
        if (isset($array[$I]) && isset($array[$I + 1])) {
            setParams($Name, $array[$I], $array[++$I]);
        }
    }
}

function UPDATEorder($ID, $IDP){
    $ID = sanitizeString($ID);
    $IDP = sanitizeString($IDP);
    $result = $GLOBALS['conn']->query("UPDATE `torders` SET"
            . "`OrderStatus`= 'отправлено' WHERE `ID` = '$ID' AND `IDPeople` = '$IDP'");
        if (!$result)
        die($GLOBALS['conn']->error);
    
}

function deleteStore($addr){
    $addr = sanitizeString($addr);
    $result = $GLOBALS['conn']->query("DELETE FROM `tmagasines` WHERE `Addres` = '$addr'");
        if (!$result)
        die($GLOBALS['conn']->error);   
}

function editStore($Name, $addr, $grafik, $firstAddr){
    $addr = sanitizeString($addr);
    $Name = sanitizeString($Name);
    $grafik = sanitizeString($grafik);
    $firstAddr = sanitizeString($firstAddr);
    $result = $GLOBALS['conn']->query("UPDATE `tmagasines` SET "
            . "`Name` ='$Name',"
            . "`Addres` = '$addr',"
            . "`Grafik` = '$grafik'"
            . " WHERE `Addres` = '$firstAddr'");
        if (!$result)
        die($GLOBALS['conn']->error);  
}

//возвращает количество товара. используется для постраничная навигации
function getCount($Maker = 'not', $type = '3', $typ = 'not') {
    $type = sanitizeString($type);
    $Maker = sanitizeString($Maker);
    if ($Maker == 'not') {
        $result = $GLOBALS['conn']->query(""
                . "SELECT count(*) FROM `ttovar` "
                . "WHERE '$type' = 3 "
                . "OR `Type` LIKE '$type%'"
                . "OR `Type` LIKE '%$typ'");
    } else {
        $result = $GLOBALS['conn']->query(""
                . "SELECT count(*) FROM `ttovar` "
                . "WHERE `Maker` = '$Maker'"
                . "AND ('$type' = 3 "
                . "OR `Type` LIKE '$type%'"
                . "OR `Type` LIKE '%$typ')");
    }
    if (!$result)
        die($GLOBALS['conn']->error);
    return $result;
}

function UPDATEpeople($PID, $name, $Pass, $Phone){
    $PID = sanitizeString($PID);
    $name = sanitizeString($name);
    $Phone = sanitizeString($Phone);
    $result = $GLOBALS['conn']->query("UPDATE `tpeople`"
            . "SET `NamePerson`= '$name' ,"
            . "`Phone` = '$Phone',"
            . "`Password`= '$Pass' "
            . "WHERE `IDPerson` = '$PID' ");

    if (!$result)
        die($GLOBALS['conn']->error);    
}

function randomPassword(){
    $chars = range('a','z');
    $bigChars = range('A','Z');
    $numbers = range(0, 9);
    $sugar = array('{','}','.',',','%','@');
    $craft = array_merge($chars,$bigChars,$numbers,$sugar);
    $random[] = array_rand($craft, 9);
    $random[] = array_rand($craft, 13);
    $random[] = array_rand($craft, 17);
    for ($I=0; $I<3; $I++){
        $password[$I] = '';
    }
    for ($I=0; $I<3; $I++){
        foreach ($random[$I] as $key=>$val)
        $password[$I] .= $craft[$val] ;
    }
    
    return $password;   
}
