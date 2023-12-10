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
$res_count = mysqli_query($link, "SELECT COUNT(*) from Dishes");
$row = mysqli_fetch_row($res_count);
$total = $row[0];
$str_pag = ceil($total / $count);
$sql_dishes = "SELECT * FROM Dishes";

if (!empty($search) && empty($sort)) {
    $sql_dishes .= " WHERE name LIKE '%$search%'";
} elseif (empty($search) && !empty($sort)) {
    $sql_dishes .= " ORDER BY price $sort";
} elseif (!empty($search) && !empty($sort)) {
    $sql_dishes .= " WHERE name LIKE '%$search%' ORDER BY price $sort";
}

$sql_dishes .= " LIMIT $art,$count";

$result_dishes = mysqli_query($link, $sql_dishes);

if ($result_dishes) {
    if (mysqli_num_rows($result_dishes) > 0) {
        echo ' <table class="table table-striped text-center">'
            . '<thead>'
            . ' <tr> '
            . '<th scope="col">Изображение</th> '
            . '<th scope="col">Название</th> '
            . ' <th scope="col">Описание</th>'
            . ' <th scope="col">Цена</th>'
            . ' <th scope="col" colspan="2"></th>'
            . '</tr> '
            . '  </thead> '
            . '  <tbody> ';
        while ($row = mysqli_fetch_array($result_dishes)) {
            echo '<tr>' .
                '<td><img src="res/uploads/' . $row['image_path'] . '" style="max-height:150px;max-width:200px;" alt="Изображение блюда"> </td>' .
                "<td> {$row['name']} </td>" .
                "<td> {$row['description']} </td>" .
                "<td> {$row['price']} </td>" .
                '<td><a href="scripts/dishes/dishes_delete.php?dish_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
                    delete
                    </span></a></td>' .
                '<td><a href="forms/dishes_form.php?dish_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
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
                echo '<li class="page-item"><a class="page-link" href="dishes.php?page=' . $i . '">' . $i . '</a></li>';
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
