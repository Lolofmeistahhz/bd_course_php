<?php
include("../../connect.php");
$fullname = $_POST['fullname'];
$pos_id = $_POST['position'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$emp_id = $_GET['emp_id'];
$sql_employee_edit = "UPDATE Employee SET fullname='$fullname',pos_id='$pos_id',email='$email',phone='$phone',address='$address' WHERE id = $emp_id";
$result = mysqli_query($link, $sql_employee_edit);
if ($result) {
    header('Location: ../../employee.php');
} else {
    echo "Произошла ошибка : " . mysqli_error($link);
}
?>