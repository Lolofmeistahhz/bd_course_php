<?php
include("../../connect.php");
if (isset($_GET['dish_id'])) {
    $dish_id = $_GET['dish_id'];

    $sql_get_path = "SELECT image_path FROM Dishes WHERE id = '$dish_id'";
    $result = mysqli_query($link, $sql_get_path);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $image_path = $row['image_path'];
        if (unlink($image_path)) {
            $sql_delete = "DELETE FROM Dishes WHERE id = '$dish_id'";
            if (mysqli_query($link, $sql_delete)) {
                header('Location: ../../dishes.php');
                exit;
            } else {
                echo "Ошибка при удалении из БД: " . mysqli_error($link);
            }
        } else {
            echo "Ошибка при удалении файла из директории.";
        }
    } else {
        echo "Ошибка: " . mysqli_error($link);
    }
}
?>