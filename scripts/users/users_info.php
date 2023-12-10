<?php
$search = isset($_POST['search']) ? trim($_POST['search']) : '';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$count = 5;
$art = ($page * $count) - $count;
$res_count = mysqli_query($link, "SELECT COUNT(*) from Users");
$row = mysqli_fetch_row($res_count);
$total = $row[0];
$str_pag = ceil($total / $count);
$sql_users = "SELECT * FROM Users";

if (!empty($search)) {
    $sql_users .= " WHERE login LIKE '%$search%'";
}

$sql_users .= " LIMIT $art,$count";

$result_users = mysqli_query($link, $sql_users);

if ($result_users) {
    if (mysqli_num_rows($result_users) > 0) {
        echo ' <table class="table table-striped text-center">'
            . '<thead>'
            . ' <tr> '
            . '<th scope="col">Логин</th> '
            . ' <th scope="col">Пароль</th>'
            . ' <th scope="col">Тип учётной записи</th>'
            . ' <th scope="col" colspan="2"></th>'
            . '</tr> '
            . '  </thead> '
            . '  <tbody> ';
        while ($row = mysqli_fetch_array($result_users)) {
            echo '<tr>' .
                "<td> {$row['login']} </td>" .
                "<td> ******* </td>" .
                "<td> {$row['user_type']} </td>" .
                '<td><a href="scripts/users/users_delete.php?user_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
                delete
                </span></a></td>' .
                '<td><a href="forms/users_form.php?user_id=' . $row['id'] . ' "><span class="material-symbols-outlined">
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
                echo '<li class="page-item"><a class="page-link" href="users.php?page=' . $i . '">' . $i . '</a></li>';
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
