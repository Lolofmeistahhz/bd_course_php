<?php
include("../../connect.php");
$name = $_POST['name'];
$salary = $_POST['salary'];
$sql_position_add = "INSERT INTO Positions (name,salary)
 VALUES ('$name','$salary')";
$result = mysqli_query($link, $sql_position_add);
if ($result) {
    header('Location: ../../positions.php');
} else {
    echo "Произошла ошибка : " . mysqli_error($link);
}
?>