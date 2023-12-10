<!DOCTYPE html>
<html lang="ru">
<?php
$title = "Заказы";
include 'header.php';
?>
<?php
include 'scripts/authorize/auth_check.php';
?>
<?php
include 'navbar.php';
?>

<body>

    <div class="container d-flex flex-column justify-content-center align-items-center mt-3" style="min-height: 75vh;">
        <?php
        $currentDate = date('Y-m-d');

        $sql_day = "SELECT calculate_order_count_by_day('$currentDate') AS order_count_day,
            calculate_order_sum_by_day('$currentDate') AS order_sum_day";
        $result_day = mysqli_query($link, $sql_day);

        $sql_month = "SELECT calculate_order_count_by_month('$currentDate') AS order_count_month,
              calculate_order_sum_by_month('$currentDate') AS order_sum_month";
        $result_month = mysqli_query($link, $sql_month);

        echo '<div class="container d-flex flex-column justify-content-center align-items-center mt-3">';
        if ($result_day) {
            $row_day = mysqli_fetch_assoc($result_day);
            $orderCountDay = $row_day['order_count_day'];
            $orderSumDay = $row_day['order_sum_day'];
            echo '<p class="mb-2"><i class="fas fa-calendar-day"></i> Заказов за сегодня: <span class="badge bg-info">' . $orderCountDay . '</span>, Сумма: <span class="badge bg-success">' . $orderSumDay . ' рублей</span></p>';
        } else {
            echo '<p class="text-danger">Ошибка выполнения запроса за сегодня: ' . mysqli_error($link) . '</p>';
        }

        if ($result_month) {
            $row_month = mysqli_fetch_assoc($result_month);
            $orderCountMonth = $row_month['order_count_month'];
            $orderSumMonth = $row_month['order_sum_month'];
            echo '<p class="mb-2"><i class="fas fa-calendar-alt"></i> Заказов за месяц: <span class="badge bg-info">' . $orderCountMonth . '</span>, Сумма: <span class="badge bg-success">' . $orderSumMonth . ' рублей</span></p>';
        } else {
            echo '<p class="text-danger">Ошибка выполнения запроса за месяц: ' . mysqli_error($link) . '</p>';
        }
        echo '</div>';
        ?>


        <div class="row mb-3">
            <div class="col-md-10">
                <form action="" method="POST" class="form-inline">
                    <div class="input-group">
                        <select class='form-select' name='filter' value='<?= $_POST['filter']; ?>'>
                            <option selected value="">По сотруднику</option>
                            <?php include 'scripts/orders/order_filter.php'; ?>
                        </select>
                        <select class='form-select' name='sort' value='<?= $_POST['sort']; ?>'>
                            <option selected value="">Сортировать</option>
                            <option value="ASC">По возрастанию</option>
                            <option value="DESC">По убыванию</option>

                        </select>
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-outline-secondary" value="Поиск" />
                        </div>
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-outline-dark" name="reset" type="reset"
                                value="Очистить" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2 text-end">
                <button class="btn btn-primary" onclick="location.href='forms/order_form.php'">Добавить</button>
            </div>
        </div>




        <?php
        include 'scripts/orders/order_info.php';
        ?>
        <script>
            document.querySelector('input[name="reset"]').addEventListener('click', function () {

                document.querySelector('input[name="filter"]').value = 'По сотруднику';
                document.querySelector('input[name="sort"]').value = 'Cортировать';

            });
        </script>
    </div>
</body>

</html>