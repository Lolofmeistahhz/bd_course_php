<?php
include("../../connect.php");
$pos_id = $_GET['pos_id'];
$name = $_POST['name'];
$salary = $_POST['salary'];
$sql_position_edit = "UPDATE Positions SET name='$name', salary='$salary' WHERE id = '$pos_id'";
$result = mysqli_query($link, $sql_position_edit);
if ($result) {
    header('Location: ../../positions.php');
} else {
    echo "Произошла ошибка : " . mysqli_error($link);
}
?>