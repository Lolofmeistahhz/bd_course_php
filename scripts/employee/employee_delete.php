<?php
include("../../connect.php");
if (isset($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];

    $sql_delete = "DELETE FROM Employee WHERE id = '$emp_id'";

    if (mysqli_query($link, $sql_delete)) {
        header('Location: ../../employee.php');
        exit;
    } else {
        echo "Ошибка при удалении: " . mysqli_error($link);
    }
}
?>
