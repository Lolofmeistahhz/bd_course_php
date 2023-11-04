<?php
include("../../connect.php");
$user_id = $_GET['user_id'];
$login = $_POST['login'];
$password = $_POST['password_hash'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT); 

$sql_user_edit = "UPDATE Users SET login='$login', password_hash='$hashed_password' WHERE id = '$user_id'";
$result = mysqli_query($link, $sql_user_edit);
if ($result) {
    header('Location: ../../users.php');
} else {
    echo "Произошла ошибка : " . mysqli_error($link);
}
?>
