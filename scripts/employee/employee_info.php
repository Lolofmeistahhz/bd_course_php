<?php
$search = isset($_POST['search']) ? trim($_POST['search']) : '';
$filter = isset($_POST['filter']) ? $_POST['filter'] : '';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$count = 5;
$art = ($page * $count) - $count;
$res_count = mysqli_query($link, "SELECT COUNT(*) from Employee");
$row = mysqli_fetch_row($res_count);
$total = $row[0];
$str_pag = ceil($total / $count);
$sql_employee = "SELECT Employee.id, Employee.fullname, Positions.name, Employee.email, Employee.phone, Employee.address 
    FROM Employee 
    INNER JOIN Positions 
    ON Positions.id = Employee.pos_id";

if (!empty($search) && empty($filter)) {
    $sql_employee .= " WHERE Employee.fullname LIKE '%$search%'";
} elseif (empty($search) && !empty($filter)) {
    $sql_employee .= " WHERE Employee.pos_id = '$filter'";
} elseif (!empty($search) && !empty($filter)) {
    $sql_employee .= " WHERE Employee.fullname LIKE '%$search%' AND Employee.pos_id = '$filter'";
}

$sql_employee .= " LIMIT $art,$count";

$result_employee = mysqli_query($link, $sql_employee);

if ($result_employee) {
    if (mysqli_num_rows($result_employee) > 0) {
        echo ' <table class="table table-striped text-center">'
            . '<thead>'
            . ' <tr> '
            . '<th scope="col">Ф.И.О</th> '
            . ' <th scope="col">Должность</th>'
            . '<th scope="col">Email</th>'
            . ' <th scope="col">Номер телефона</th>'
            . ' <th scope="col">Адрес проживания</th>'
            . ' <th scope="col" colspan="2"></th>'
            . '</tr> '
            . '  </thead> '
            . '  <tbody> ';
        while ($row = mysqli_fetch_array($result_employee)) {
            echo '<tr>' .
                "<td> {$row['fullname']} </td>" .
                "<td> {$row['name']} </td>" .
                "<td> {$row['email']} </td>" .
                "<td> {$row['phone']} </td>" .
                "<td> {$row['address']} </td>" .
                '<td><a href="scripts/employee/employee_delete.php?emp_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
                delete
                </span></a></td>' .
                '<td><a href="forms/employee_form.php?emp_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
                edit
                </span></a></td>' .
                '</tr>';
        }
        echo '</tbody>';
        echo '</table>';

        if (empty($search)) {
            echo '<div class="d-flex justify-content-center">';
            echo '<ul class="pagination">';
            for ($i = 1; $i <= $str_pag; $i++) {
                echo '<li class="page-item"><a class="page-link" href="employee.php?page=' . $i . '">' . $i . '</a></li>';
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
?>
