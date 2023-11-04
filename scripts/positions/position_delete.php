<?php
include("../../connect.php");
if (isset($_GET['pos_id'])) {
    $pos_id = $_GET['pos_id'];

    $sql_delete = "DELETE FROM Positions WHERE id = '$pos_id'";

    if (mysqli_query($link, $sql_delete)) {
        header('Location: ../../positions.php');
        exit;
    } else {
        echo "Ошибка при удалении: " . mysqli_error($link);
    }
}
?>