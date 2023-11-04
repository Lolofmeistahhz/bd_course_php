<?php
    $connect = "localhost";
    $root ="root";
    $pass = "";
    $db = "Restaraunt";

    $link = mysqli_connect($connect, $root, $pass, $db);

    if (!$link){
        echo "Ошибка. Нет соединения";
        echo '<br>';
        echo "Код ошибки: " . mysqli_connect_errno();
        echo '<br>';
        echo "Текст ошибки: " . mysqli_connect_error();
        exit; 
    }

    // echo "Успешно подключено";
    // echo '<br>';
?>