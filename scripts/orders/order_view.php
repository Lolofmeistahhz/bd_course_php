<?php
$title = "Заказы";
include '../../header.php';
?>
<?php
include '../../scripts/authorize/auth_check.php';
?>
<?php
include("../../connect.php");

$o_id = $_GET["order_id"];
$sql_order_summary = "SELECT * FROM orderssummary WHERE order_id = $o_id";

$result_orders = mysqli_query($link, $sql_order_summary);

if ($result_orders) {
    if (mysqli_num_rows($result_orders) > 0) {
        echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh; width: 100%;">';
        echo '<div class="card text-center" style="width: 50%;">';
        echo '<div class="card-header">Информация о заказе</div>';
        echo '<div class="card-body">';
        $row = mysqli_fetch_array($result_orders);
        echo "<p class='card-text' style='text-align: center;'>Сотрудник: {$row['employee_name']}</p>";
        echo "<p class='card-text' style='text-align: center;'>Столик: {$row['table_number']}</p>";
        echo "<p class='card-text' style='text-align: center;'>Заказанные блюда: {$row['dishes_ordered']}</p>";
        echo "<p class='card-text' style='text-align: center;'>Итого: {$row['total_price']}</p>";
        echo '</div>';
        echo '<a href="javascript:history.go(-1)" style="text-align: center;">Назад</a>';
        echo '</div>';
        echo '</div>';
        echo '<div class="d-flex justify-content-center">';
        echo '<ul class="pagination">';
    } else {
        echo "<div style='text-align: center;'>Нет данных для отображения.</div>";
    }
} else {
    echo "<div style='text-align: center;'>Произошла ошибка: " . mysqli_error($link) . "</div>";
}
?>