<?php
include("../../connect.php");
$log = $_POST['login'];
$password = $_POST['password_hash'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT); 

$sql_user_add = "INSERT INTO Users (login, password_hash,user_type) VALUES ('$log', '$hashed_password','$user_type')";
$result = mysqli_query($link, $sql_user_add);
if ($result) {
    header('Location: ../../users.php');
} else {
    echo "Произошла ошибка : " . mysqli_error($link);
}
?>
