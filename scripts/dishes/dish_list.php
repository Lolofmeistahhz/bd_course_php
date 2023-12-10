<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$count = 9;

$art = ($page * $count) - $count;

$res_count = mysqli_query($link, "SELECT COUNT(*) FROM Dishes");
$row = mysqli_fetch_row($res_count);

if (isset($row[0]) && is_numeric($row[0]) && $row[0] > 0) {
    $total = $row[0];

    $str_pag = ceil($total / $count);

    $sql_dishes = "SELECT * FROM Dishes LIMIT $art, $count";
    $result_dishes = mysqli_query($link, $sql_dishes);

    if ($result_dishes) {
        if (mysqli_num_rows($result_dishes) > 0) {
            echo '<div class="row mt-5">';
            while ($row = mysqli_fetch_array($result_dishes)) {
                echo
                    '<div class="col-md-4 mt-3">' .
                    '<div class="card" style="height:500px;">' .
                    '<img src="res/uploads/' . $row['image_path'] . ' "style="height:200px;" alt="Изображение блюда">' .
                    '<div class="card-body">' .
                    "<h5 class='card-title'>{$row['name']} </h5>" .
                    "<p class='card-text'>Описание: <br> {$row['description']}</p>" .
                    "<p class='card-text'>Цена: {$row['price']} рублей</p>" .
                    '</div>' .
                    '</div>' .
                   
                    '</div>';
            }
            echo '</div>';
            echo '<div class="d-flex justify-content-center">';
            echo '<ul class="pagination mt-5">';
            for ($i = 1; $i <= $str_pag; $i++) {
                echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        } else {
            echo "Нет данных для отображения.";
        }
    } else {
        echo "Произошла ошибка: " . mysqli_error($link);
    }
} else {
    echo "Ошибка при получении общего числа записей в таблице Dishes.";
}
?>