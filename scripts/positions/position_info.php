<?php
$search = isset($_POST['search']) ? trim($_POST['search']) : '';
$sort = isset($_POST['sort']) ? trim($_POST['sort']) : '';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$count = 5;
$art = ($page * $count) - $count;
$res_count = mysqli_query($link, "SELECT COUNT(*) from Positions");
$row = mysqli_fetch_row($res_count);
$total = $row[0];
$str_pag = ceil($total / $count);
$sql_positions = "SELECT * FROM Positions";

if (!empty($search) && empty($sort)) {
    $sql_positions .= " WHERE name LIKE '%$search%'";
} elseif (empty($search) && !empty($sort)) {
    $sql_positions .= " ORDER BY salary $sort";
} elseif (!empty($search) && !empty($sort)) {
    $sql_positions .= " WHERE name LIKE '%$search%' ORDER BY salary $sort";
}

$sql_positions .= " LIMIT $art,$count";

$result_postions = mysqli_query($link, $sql_positions);

if ($result_postions) {
    if (mysqli_num_rows($result_postions) > 0) {
        echo ' <table class="table table-striped text-center">'
            . '<thead>'
            . ' <tr> '
            . '<th scope="col">Название</th> '
            . ' <th scope="col">Зарплата</th>'
            . ' <th scope="col" colspan="2"></th>'
            . '</tr> '
            . '  </thead> '
            . '  <tbody> ';
        while ($row = mysqli_fetch_array($result_postions)) {
            echo '<tr>' .
                "<td> {$row['name']} </td>" .
                "<td> {$row['salary']} </td>" .
                '<td><a href="scripts/positions/position_delete.php?pos_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
                delete
                </span></a></td>' .
                '<td><a href="forms/position_form.php?pos_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
                edit
                </span></a></td>' .
                '</tr>';
        }
        echo '</tbody>';
        echo '</table>';

        // Пагинация будет выводиться только если не применена фильтрация или сортировка
        if (empty($search) && empty($sort)) {
            echo '<div class="d-flex justify-content-center">';
            echo '<ul class="pagination">';
            for ($i = 1; $i <= $str_pag; $i++) {
                echo '<li class="page-item"><a class="page-link" href="positions.php?page=' . $i . '">' . $i . '</a></li>';
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
