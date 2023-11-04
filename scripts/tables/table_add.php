<?php
include("../../connect.php");
$number = $_POST['number'];
$place = $_POST['placeCount'];
$hall_id = $_POST['hall'];
$sql_table_add = "INSERT INTO Tables (number,placeCount,hall_id)
 VALUES ('$number','$place','$hall_id')";
$result = mysqli_query($link, $sql_table_add);
if ($result) {
    header('Location: ../../tables.php');
} else {
    echo "Произошла ошибка : " . mysqli_error($link);
}
?>