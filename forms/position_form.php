<?php
$title = isset($pos_id) ? 'Редактирование должности' : 'Добавление должности';
include '../header.php';
?>
<?php
include '../scripts/authorize/auth_check.php';
?>
<?php
include '../scripts/authorize/user_type_check.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <?php
    if (isset($_GET['pos_id'])) {
        $pos_id = $_GET['pos_id'];
        $action = "../scripts/positions/position_edit.php?pos_id=" . $pos_id;
        $current_position = "SELECT * FROM Positions WHERE id = $pos_id";
        $result = mysqli_query($link, $current_position);
        if ($result) {
            $res_arr = mysqli_fetch_array($result);
        } else {
            echo "Произошла ошибка : " . mysqli_error($link);
        }
    } else {
        $action = "../scripts/positions/position_add.php";
    }
    ?>
    <form method="post" action="<?= $action ?>" class="form-outline mb-4">
        <h1 class="text-center">
            <?php echo isset($pos_id) ? 'Редактирование должности' : 'Добавление должности' ?>
        </h1>
        <div class="row">
            <div class="col-md-12">
                <label class="form-label" for="name">Название должности</label>
                <input type="text" name="name" placeholder="Менеджер" class="form-control"
                    value="<?php echo $res_arr['name'] ?>" required="required" />
                <label class="form-label" for="salary">Зарплата</label>
                <input type="number" name="salary" placeholder="30000" class="form-control"
                    value="<?php echo $res_arr['salary'] ?>" required="required" />
            </div>

        </div>
        <input type="submit" name="add" class="btn btn-primary btn-block mb-4 mt-3"
            value="<?php echo isset($res_arr['id']) ? 'Сохранить' : 'Добавить' ?>"></input>
    </form>
</div>