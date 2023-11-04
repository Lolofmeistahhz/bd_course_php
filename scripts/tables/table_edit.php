<?php
include("../../connect.php");
$number = $_POST['number'];
$place = $_POST['placeCount'];
$hall_id = $_POST['hall'];
$table_id = $_GET['table_id'];
$sql_table_edit = "UPDATE Tables SET number='$number',placeCount='$place',hall_id='$hall_id' WHERE id = $hall_id";
$result = mysqli_query($link, $sql_table_edit);
if ($result) {
    header('Location: ../../tables.php');
} else {
    echo "Произошла ошибка : " . mysqli_error($link);
}
?>