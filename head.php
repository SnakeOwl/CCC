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
    <link rel="SHORTCUT ICON" href="./Images/mouse.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="buttons.css">
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-
    MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" defer></script>
    
    
</head>
