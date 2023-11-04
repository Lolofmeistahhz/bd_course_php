<?php
include("../../connect.php");
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $sql_delete = "DELETE FROM Orders WHERE id = '$order_id'";

    if (mysqli_query($link, $sql_delete)) {
        header('Location: ../../orders.php');
        exit;
    } else {
        echo "Ошибка при удалении: " . mysqli_error($link);
    }
}
?>