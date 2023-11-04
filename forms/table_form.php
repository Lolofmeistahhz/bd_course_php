<?php
$title = isset($emp_id) ? 'Редактирование сотрудника' : 'Добавление сотрудника';
include '../header.php';
?>
<?php
include '../scripts/authorize/auth_check.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <?php
    if (isset($_GET['table_id'])) {
        $table_id = $_GET['table_id'];
        $action = "../scripts/tables/table_edit.php?table_id=" . $table_id;
        $current_table = "SELECT Tables.id, Halls.name, Tables.number, Tables.placeCount
        FROM Tables 
        INNER JOIN Halls 
        ON Halls.id = Tables.hall_id WHERE Tables.id = $table_id";
        $result = mysqli_query($link, $current_table);
        if ($result) {
            $res_arr = mysqli_fetch_array($result);
        } else {
            echo "Произошла ошибка : " . mysqli_error($link);
        }
    } else {
        $action = "../scripts/tables/table_add.php";
    }
    ?>
    <form method="post" action="<?= $action ?>" class="form-outline mb-4">
        <h1 class="text-center">
            <?php echo isset($emp_id) ? 'Редактирование столика' : 'Добавление столика' ?>
        </h1>
        <div class="row">
            <div class="col-md-12">
                <label class="form-label" for="number">Номер столика</label>
                <input type="number" name="number" placeholder="1" class="form-control"
                    value="<?php echo $res_arr['number'] ?>" required="required" />
                <label class="form-label" for="placeCount">Количество посадочных мест</label>
                <input type="number" name="placeCount" placeholder="4" class="form-control"
                    value="<?php echo $res_arr['placeCount'] ?>" required="required" />

            </div>
        </div>
        <label class="form-label mt-3" for="hall">Зал </label>
        <select class="form-select" style="min-width:100%;" name="hall" required="required">

            <?php include '../scripts/tables/tables_filter.php'; ?>
        </select>
        <br>
        <input type="submit" name="add" class="btn btn-primary btn-block mb-4 mt-3"
            value="<?php echo isset($res_arr['id']) ? 'Сохранить' : 'Добавить' ?>"></input>
    </form>
</div>