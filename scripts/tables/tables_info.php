<?php
$filter = isset($_POST['filter']) ? $_POST['filter'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : '';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else
    $page = 1;
$count = 5;
$art = ($page * $count) - $count;
$res_count = mysqli_query($link, "SELECT COUNT(*) from Tables");
$row = mysqli_fetch_row($res_count);
$total = $row[0];
$str_pag = ceil($total / $count);
$sql_table = "SELECT Tables.id, Halls.name, Tables.number, Tables.placeCount
    FROM Tables 
    INNER JOIN Halls 
    ON Halls.id = Tables.hall_id";
if (!empty($sort) && empty($filter)) {
    $sql_table .= " ORDER BY number $sort";
} elseif (empty($sort) && !empty($filter)) {
    $sql_table .= " WHERE Tables.hall_id = '$filter'";
} elseif (!empty($sort) && !empty($filter)) {
    $sql_table .= " ORDER BY number $sort WHERE Employee.fullname LIKE '%$search%' AND Employee.pos_id = '$filter'";
}

$sql_table .= " LIMIT $art,$count";



$result_tables = mysqli_query($link, $sql_table);

if ($result_tables) {
    if (mysqli_num_rows($result_tables) > 0) {
        echo ' <table class="table table-striped text-center">'
            . '<thead>'
            . ' <tr> '
            . '<th scope="col">Номер столика</th> '
            . ' <th scope="col">Количество посадочных мест</th>'
            . '<th scope="col">Зал</th>'
            . ' <th scope="col" colspan="2"></th>'
            . '</tr> '
            . '  </thead> '
            . '  <tbody> ';
        while ($row = mysqli_fetch_array($result_tables)) {
            echo '<tr>' .
                "<td> {$row['number']} </td>" .
                "<td> {$row['placeCount']} </td>" .
                "<td> {$row['name']} </td>" .
                '<td><a href="scripts/tables/table_delete.php?table_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
                delete
                </span></a></td>' .
                '<td><a href="forms/table_form.php?table_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
                edit
                </span></a></td>' .
                '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<div class="d-flex justify-content-center">';
        echo '<ul class="pagination">';
        for ($i = 1; $i <= $str_pag; $i++) {
            echo '<li class="page-item"><a class="page-link" href="tables.php?page=' . $i . '">' . $i . '</a></li>';
        }
        echo '</ul>';
        echo '</div>';



    } else {
        echo "Нет данных для отображения.";
    }
} else {
    echo "Произошла ошибка: " . mysqli_error($link);
}
?>