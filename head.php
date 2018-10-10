<?php
include_once './metods.php';

if (isset($_COOKIE['ID']) & isset($_COOKIE['password'])) {
    $peoples = getPeopleByID($_COOKIE['ID']);
    $mdpass = $_COOKIE['password'];
    $people = $peoples->fetch_array(MYSQLI_ASSOC);
    //если такого пользователя в базе нету
    if (isset($people)) {
        if ($mdpass == $people['Password']) {
            cooki($people['IDPerson'], $mdpass);
        }
    } else{
        unLog();
    }
}
?>

    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <title>Quick mouses</title>
        <meta charset="UTF-8">
        <script src="./Jquery.js"></script>
        <link rel="SHORTCUT ICON" href="./Images/mouse.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="engine1/style.css" />

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="buttons.css">
    </head>
