<?php
include("../../connect.php");

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $target_dir = "../../res/uploads/";
    $target_file = $target_dir . basename($_FILES["image_path"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image_path"]["tmp_name"]);
        if ($check !== false) {
            echo "Файл является изображением - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Файл не является изображением.";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        echo "Извините, файл уже существует.";
        $uploadOk = 0;
    }

    if ($_FILES["image_path"]["size"] > 500000) {
        echo "Извините, ваш файл слишком большой.";
        $uploadOk = 0;
    }

    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Извините, разрешены только файлы JPG, JPEG, PNG и GIF.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Извините, ваш файл не был загружен.";
    } else {
        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
            echo "Файл " . htmlspecialchars(basename($_FILES["image_path"]["name"])) . " был загружен.";
        } else {
            echo "Произошла ошибка при загрузке файла.";
        }
    }

    $sql_dish_add = "INSERT INTO Dishes (name, price, description, image_path)
    VALUES ('$name','$price','$description','$target_file')";
    $result = mysqli_query($link, $sql_dish_add);

    if ($result) {
        header('Location: ../../dishes.php');
    } else {
        echo "Произошла ошибка : " . mysqli_error($link);
    }
}
?>