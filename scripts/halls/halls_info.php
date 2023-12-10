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
$res_count = mysqli_query($link, "SELECT COUNT(*) from Halls");
$row = mysqli_fetch_row($res_count);
$total = $row[0];
$str_pag = ceil($total / $count);
$sql_halls = "SELECT * FROM Halls";

if (!empty($search) && empty($sort)) {
    $sql_halls .= " WHERE name LIKE '%$search%'";
} elseif (empty($search) && !empty($sort)) {
    $sql_halls .= " ORDER BY name $sort";
} elseif (!empty($search) && !empty($sort)) {
    $sql_halls .= " WHERE name LIKE '%$search%' ORDER BY name $sort";
}

$sql_halls .= " LIMIT $art,$count";

$result_halls = mysqli_query($link, $sql_halls);

if ($result_halls) {
    if (mysqli_num_rows($result_halls) > 0) {
        echo ' <table class="table table-striped text-center">'
            . '<thead>'
            . ' <tr> '
            . '<th scope="col">Название</th> '
            . ' <th scope="col">Описание</th>'
            . ' <th scope="col" colspan="2"></th>'
            . '</tr> '
            . '  </thead> '
            . '  <tbody> ';
        while ($row = mysqli_fetch_array($result_halls)) {
            echo '<tr>' .
                "<td> {$row['name']} </td>" .
                "<td> {$row['description']} </td>" .
                '<td><a href="scripts/halls/halls_delete.php?hall_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
                delete
                </span></a></td>' .
                '<td><a href="forms/halls_form.php?hall_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
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
                echo '<li class="page-item"><a class="page-link" href="halls.php?page=' . $i . '">' . $i . '</a></li>';
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
