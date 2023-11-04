<?php
include("../../connect.php");
$hall_id = $_GET['hall_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$sql_hall_edit = "UPDATE Halls SET name='$name', description='$description' WHERE id = '$hall_id'";
$result = mysqli_query($link, $sql_hall_edit);
if ($result) {
    header('Location: ../../halls.php');
} else {
    echo "Произошла ошибка : " . mysqli_error($link);
}
?>