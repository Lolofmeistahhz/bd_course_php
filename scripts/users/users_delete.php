<?php
include("../../connect.php");
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql_delete = "DELETE FROM Users WHERE id = '$user_id'";

    if (mysqli_query($link, $sql_delete)) {
        header('Location: ../../users.php');
        exit;
    } else {
        echo "Ошибка при удалении: " . mysqli_error($link);
    }
}
?>