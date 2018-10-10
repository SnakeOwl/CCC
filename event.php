<?php

include_once './metods.php';



// занесение товара
if (isset($_POST['Tovar'])) {

    if (isset($_POST['nameTovar'])) {
        setTovar($_POST['nameTovar'], $_POST['Price'], $_POST['type'], $_POST['maker'], $_POST['description'], $_POST['garant']);
        mkdir("./Images/{$_POST['nameTovar']}");
//запись картинок
        for ($I = 1; $I < 5; $I++) {
// переменные для удобства
            $filePath = $_FILES["img$I"]['tmp_name'];
            $errorCode = $_FILES["img$I"]['error'];

// Проверка на ошибки
            if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
// Массив с названиями ошибок
                $errorMessages = [
                    UPLOAD_ERR_INI_SIZE => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                    UPLOAD_ERR_FORM_SIZE => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                    UPLOAD_ERR_PARTIAL => 'Загружаемый файл был получен только частично.',
                    UPLOAD_ERR_NO_FILE => 'Файл не был загружен.',
                    UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                    UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                    UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла.',
                ];
// Зададим неизвестную ошибку
                $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
// Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
                $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
// Выведем название ошибки
                die($outputMessage);
            }

// Создадим ресурс FileInfo
            $fi = finfo_open(FILEINFO_MIME_TYPE);

// Получим MIME-тип
            $mime = (string) finfo_file($fi, $filePath);

// Проверим ключевое слово image (image/jpeg, image/png и т. д.)
            if (strpos($mime, 'image') === false)
                die('Можно загружать только изображения.');
// Результат функции запишем в переменную
            $image = getimagesize($filePath);

// Зададим ограничения для картинок (5M)
            $limitBytes = 1024 * 1024 * 5;

            if (filesize($filePath) > $limitBytes)
                die('Размер изображения не должен превышать 5 Мбайт.');

            if (!move_uploaded_file($filePath, "./Images/{$_POST['nameTovar']}/{$_FILES["img$I"]['name']}")) {
                die('При записи изображения на диск произошла ошибка.');
            }
        }

//запись параметров
        $array = explode(';', $_POST['parameter']);
        $trueArray = [];
        for ($I = 0; $I < count($array); $I++) {
            if (isset($array[$I]) && isset($array[$I + 1])) {
                setParams($_POST['nameTovar'], $array[$I], $array[++$I]);
            }
        }
        header("Location: panel.php");
        exit();
    }
}

if (isset($_POST['rebat'])) {
    setRebate($_POST['rebate']);
    header("Location: panel.php");
}

//удаление скидок
if (isset($_POST['deleteRebate'])) {
    deleteRebates();
    header("Location: panel.php");
}

//используется при регистрации пользователя через панель
if (isset($_POST['people'])) {
    $mdPass = md5($_POST['password']);
    setPeople($_POST['name'], $_POST['balance'], $mdPass);
    header('Location: ./panel.php');
}

//при регистрации нового пользователя из формы регисрации
if (isset($_POST['newPeople'])) {
    $mdPass = md5($_POST['password']);
    setPeople($_POST['name'], 0, $mdPass, $_POST['number']);
    
    $peoples = getPeople($_POST['name']);
    
    while ($people = $peoples->fetch_array(MYSQLI_ASSOC)) {
        if ($mdPass == $people['Password']) {
            cooki($people['IDPerson'], $mdPass);
            header('Location: ./index.php');
            exit();
        }
    }
    
    header('Location: ./index.php');
}

//вызывается при попытке входа
if (isset($_POST['Login'])) {
    $peoples = getPeople($_POST['name']);
    $mdpass = md5($_POST['password']);
    while ($people = $peoples->fetch_array(MYSQLI_ASSOC)) {
        if ($mdpass == $people['Password']) {
            cooki($people['IDPerson'], $mdpass);
            header('Location: ./index.php');
            exit();
        }
    }
    header('Location: ./Registration.php');
}

//используется для удаления кук
if (isset($_GET['unLog'])) {
    unLog();
}

//занесение магазинов из панели
if (isset($_POST['magasine'])) {
    setStore($_POST['nameStore'], $_POST['addr'], $_POST['grafik']);
    header('Location: ./panel.php');
    exit();
}

if (isset($_POST['addTov'])) {
    addTovar($_POST['name']);
}

if (isset($_POST['delTov'])) {
    delTovar($_POST['name']);
    header("Location: box.php");
}

//функция для работы поисковика
if (isset($_GET['f'])) {
    $name = sanitizeString($_GET['f']);
    $tov = getTovar($name);
//по идее сработает 1 раз
    while ($tov = $tov->fetch_array(MYSQLI_ASSOC)) {
        header("Location: ./tovar.php?name={$tov['Name']}");
        exit();
    }
//если такого товара нету то выдает переменную в гет запросе
    header("Location: ./index.php?f=not");
}

//удаление товара из базы данных
if (isset($_POST['delet'])) {
    deletTovar($_POST['nameTovar']);
    header("Location: ./index.php");
}

//коментарии к и оценка товару
if (isset($_POST['revie'])) {
    setReview($_POST['nameTovar'], $_POST['reviev']);
    setRaiting($_POST['nameTovar'], $_POST['reit']);
    header("Location: ./tovar.php?name={$_POST['nameTovar']}");
}

//выполнение заказа
if (isset($_POST['ZAKAZ'])) {
    if (isset($_COOKIE['ID']) & isset($_COOKIE['password'])) {
        $peoples = getPeopleByID($_COOKIE['ID']);
        $mdpass = $_COOKIE['password'];
        $people = $peoples->fetch_array(MYSQLI_ASSOC);

        //если такого пользователя в базе нету
        if (isset($people)) {
            if ($mdpass == $people['Password']) {

                $out = '';
                if ($_POST['radio'] == 'забрать из магазина') {
                    $out .= "наш магазин по адресу:" . $_POST['City'];
                } elseif ($_POST['radio'] == 'доставка курьером') {
                    $out .= "доставка курьером по адресу:" . $_POST['addr'];
                } elseif ($_POST['radio'] == 'доствка почтой') {
                    $out .= "доставка почтой по адресу:" . $_POST['addr'];
                    if (isset($_POST['mail']))
                        $out .= "; почтовый индекс: ";
                }
                if ($out == '')
                    header('Location: ./box.php');

                $tovarNames = "";
                $sum = 0;

                foreach ($_POST['nameTovar'] as $key => $value) {

                    $tovar = getTovar($value);
                    $tov = $tovar->fetch_array(MYSQLI_ASSOC);
                    $sum += $tov['Cell'];
                    $tovarNames = $tovarNames . $tov['Name'] . ' ; ';
                    delTovar($value);
                }
                $rebate = getRebate();
                $rebat = $rebate->fetch_array(MYSQLI_ASSOC);
                $price = (isset($rebat)) ? $sum - $sum / 100 * $rebat['Rebate'] : $sum;
                $price = round($price, 2);
                if ($people['balance'] > $price) {
                    setOrder($tovarNames, $price, $_POST['peopId'], $rebat['Rebate'], $out);
                    UPDATEPeopleBalance($price, $_POST['peopId'], '-');
                }
                header("Location: Profile.php");
            }
        } else {
            unLog();
        }
    }
}

//пополнение счета
if (isset($_POST['getMoney'])) {
    UPDATEPeopleBalance($_POST['getMoney'], $_POST['ID'], '+');
}

//удаление или редактирование одного товара
if (isset($_GET['admin']) && (isset($_GET['del']) || isset($_GET['edd']) )) {
    if (isset($_GET['del']) && $_GET['admin'] == 'scorpion') {
        deletTovar($_GET['del']);
        header("Location: ./panel.php");
    }
    if (isset($_GET['edd']) && $_GET['admin'] == 'scorpion') {
        header("Location: ./panel.php?edit[]={$_GET['edd']}");
    }
}

//редактировать все выделенные товары
if (isset($_POST['allEdd'])) {
    $arrayUrl = 'sozdatel=Nikolay';
    if (isset($_POST['nameTovar']))
        foreach ($_POST['nameTovar'] as $key => $val) {
            $arrayUrl .= "&edit[]=$val";
        }
    header("Location: ./panel.php?$arrayUrl");
}

//принять редактирование всех товаров
if (isset($_POST['TovarEdd'])) {
    $I = 0;
    foreach ($_POST['nameTovar'] as $key => $val) {
        UPDATETovar($_POST['nameTovar'][$I], $_POST['Price'][$I], $_POST['description'][$I], $_POST['type'][$I], $_POST['maker'][$I], $_POST['firstName'][$I], $_POST['garant'][$I], $_POST['parameter'][$I]);
        $I++;
    }
    header("Location: ./panel.php");
}

//удалить все выбранные товары
if (isset($_POST['allDel'])) {
    foreach ($_POST['nameTovar'] as $key => $val) {
        deletTovar($val);
    }
    header("Location: ./panel.php");
}

//происходит когда оператор отправляет товар
if (isset($_GET['IDP'])) {
    UPDATEorder($_GET['ID'], $_GET['IDP']);
    header("Location: orders.php");
}

//удаленние магазина
if (isset($_POST['delStore'])) {
    deleteStore($_POST['addr']);
    header("Location: stores.php");
}

//изменение информации о магазине
if (isset($_POST['editStore'])) {
    header("Location: stores.php?edit=" . $_POST['addr']);
}

if (isset($_POST['editMagasine'])) {
    editStore($_POST['nameStore'], $_POST['addr'], $_POST['grafik'], $_POST['firstaddr']);
    header("Location: stores.php");
}

if(isset($_POST['editPeople'])){
    $mdpas = md5($_POST['password']);
    
    UPDATEpeople($_POST['id'], $_POST['name'], $mdpas, $_POST['number']);
    cooki($_POST['id'], $mdpas);
    header("Location: Profile.php");
    
}

//если что-то пошло не так возвратить на стартовую страницу
//header("Location: index.php");
