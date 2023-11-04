<?php
$title = isset($hall_id) ? 'Редактирование зала' : 'Добавление зала';
include '../header.php';
?>
<?php
include '../scripts/authorize/auth_check.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <?php
    if (isset($_GET['hall_id'])) {
        $hall_id = $_GET['hall_id'];
        $action = "../scripts/halls/halls_edit.php?hall_id=" . $hall_id;
        $current_hall = "SELECT * FROM Halls WHERE id = $hall_id";
        $result = mysqli_query($link, $current_hall);
        if ($result) {
            $res_arr = mysqli_fetch_array($result);
        } else {
            echo "Произошла ошибка : " . mysqli_error($link);
        }
    } else {
        $action = "../scripts/halls/halls_add.php";
    }
    ?>
    <form method="post" action="<?= $action ?>" class="form-outline mb-4">
        <h1 class="text-center">
            <?php echo isset($hall_id) ? 'Редактирование зала' : 'Добавление зала' ?>
        </h1>
        <div class="row">

            <div class="col-md-12">
                <label class="form-label" for="name">Название зала</label>
                <input type="text" name="name" placeholder="Азиатский" class="form-control"
                    value="<?php echo $res_arr['name'] ?>" required="required" />
                <label class="form-label" for="description">Описание зала</label>
                <textarea name="description" placeholder="Зал в азиатском стиле"
                    class="form-control"><?php echo $res_arr['description'] ?></textarea>
            </div>

        </div>
        <input type="submit" name="add" class="btn btn-primary btn-block mb-4 mt-3"
            value="<?php echo isset($res_arr['id']) ? 'Сохранить' : 'Добавить' ?>"></input>
    </form>
</div>