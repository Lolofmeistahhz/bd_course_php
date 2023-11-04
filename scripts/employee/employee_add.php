<?php
include("../../connect.php");
$fullname = $_POST['fullname'];
$pos_id = $_POST['position'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$sql_employee_add = "INSERT INTO Employee (fullname,pos_id,email,phone,address)
 VALUES ('$fullname','$pos_id','$email','$phone','$address')";
$result = mysqli_query($link, $sql_employee_add);
if ($result) {
    header('Location: ../../employee.php');
} else {
    echo "Произошла ошибка : " . mysqli_error($link);
}
?>