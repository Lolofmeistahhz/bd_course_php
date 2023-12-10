<?php
include("../../connect.php");

if (isset($_POST['add'])) {
    $fullname = $_POST['fullname'];
    $number = $_POST['number'];
    // $order_date = $_POST['order_date-time'];
    $order_date = date("Y-m-d H:i:s"); 

    $sql_order_add = "INSERT INTO Orders (emp_id, table_id, order_date)
    VALUES ('$fullname', '$number', '$order_date')";
    $result = mysqli_query($link, $sql_order_add);

    $order_id = mysqli_insert_id($link);

    if ($result) {
        $dishCounter = 1;
        while (isset($_POST["dish" . $dishCounter])) {
            $dish_id = $_POST["dish" . $dishCounter];
            $sql_ordered_dishes_add = "INSERT INTO OrderedDishes (dish_id, order_id)
            VALUES ('$dish_id', '$order_id')";
            $result_dish = mysqli_query($link, $sql_ordered_dishes_add);
            $dishCounter++;
        }
        header('Location: ../../orders.php');
    } else {
        echo "Произошла ошибка при добавлении заказа: " . mysqli_error($link);
    }
}
?>