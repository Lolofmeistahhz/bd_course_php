<?php
include("../../connect.php");
if (isset($_GET['table_id'])) {
    $table_id = $_GET['table_id'];

    $sql_delete = "DELETE FROM Tables WHERE id = '$table_id'";

    if (mysqli_query($link, $sql_delete)) {
        header('Location: ../../tables.php');
        exit;
    } else {
        echo "Ошибка при удалении: " . mysqli_error($link);
    }
}
?>