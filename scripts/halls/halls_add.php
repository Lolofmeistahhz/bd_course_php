<?php
include("../../connect.php");
$name = $_POST['name'];
$description = $_POST['description'];
$sql_hall_add = "INSERT INTO Halls (name,description)
 VALUES ('$name','$description')";
$result = mysqli_query($link, $sql_hall_add);
if ($result) {
    header('Location: ../../halls.php');
} else {
    echo "Произошла ошибка : " . mysqli_error($link);
}
?>