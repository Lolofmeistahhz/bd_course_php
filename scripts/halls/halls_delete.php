<?php
include("../../connect.php");
if (isset($_GET['hall_id'])) {
    $hall_id = $_GET['hall_id'];

    $sql_delete = "DELETE FROM Halls WHERE id = '$hall_id'";

    if (mysqli_query($link, $sql_delete)) {
        header('Location: ../../halls.php');
        exit;
    } else {
        echo "Ошибка при удалении: " . mysqli_error($link);
    }
}
?>