<?php
session_start();
$filter = isset($_POST['filter']) ? $_POST['filter'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : '';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else
    $page = 1;
$count = 5;
$art = ($page * $count) - $count;
$res_count = mysqli_query($link, "SELECT COUNT(*) from Orders");
$row = mysqli_fetch_row($res_count);
$total = $row[0];
$str_pag = ceil($total / $count);
$sql_order = "SELECT Orders.id, Employee.fullname, Tables.number, Orders.order_date FROM Orders 
    INNER JOIN Employee 
    ON Employee.id = Orders.emp_id INNER JOIN Tables on Tables.id = Orders.table_id";
if (!empty($sort) && empty($filter)) {
    $sql_order .= " ORDER BY order_date $sort";
} elseif (empty($sort) && !empty($filter)) {
    $sql_order .= " WHERE Orders.emp_id = '$filter'";
} elseif (!empty($sort) && !empty($filter)) {
    $sql_order .= " ORDER BY order_date $sort WHERE Orders.emp_id = '$filter'";
}

$sql_order .= " LIMIT $art,$count";

$result_orders = mysqli_query($link, $sql_order);


if ($result_orders) {
    if (mysqli_num_rows($result_orders) > 0) {
        echo ' <table class="table table-striped text-center">'
            . '<thead>'
            . ' <tr> '
            . '<th scope="col">Сотрудник</th> '
            . ' <th scope="col">Столик</th>'
            . '<th scope="col">Дата</th>'
            . ' <th scope="col" colspan="3"></th>'
            . '</tr> '
            . '  </thead> '
            . '  <tbody> ';
        while ($row = mysqli_fetch_array($result_orders)) {
            echo '<tr>' .
                "<td> {$row['fullname']} </td>" .
                "<td> {$row['number']} </td>" .
                "<td> {$row['order_date']} </td>" .
                '<td><a data-bs-toggle="collapse" href="scripts/orders/order_view.php?order_id=' . $row['id'] . '"><span class="material-symbols-outlined">
                visibility
                </span></a></td>';
            if ($_SESSION['user_type'] == 'admin') {
                echo '<td><a href="scripts/orders/order_delete.php?order_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
                    delete
                    </span></a></td>';
            }

            echo '</tr>';
            echo '<tr class="collapse" id="orderDetails' . $row['id'] . '">';
            echo '<td colspan="6">';
            echo '<div class="card card-body">';
            echo '</div>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';

        if (empty($filter) && empty($sort)) {
            echo '<div class="d-flex justify-content-center">';
            echo '<ul class="pagination">';
            for ($i = 1; $i <= $str_pag; $i++) {
                echo '<li class="page-item"><a class="page-link" href="orders.php?page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        }

    } else {
        echo "Нет данных для отображения.";
    }
} else {
    echo "Произошла ошибка: " . mysqli_error($link);
}