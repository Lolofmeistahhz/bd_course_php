<?php
$title = isset($dish_id) ? 'Редактирование блюда' : 'Добавление блюда';
include '../header.php';
?>
<?php
include '../scripts/authorize/auth_check.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <?php
    if (isset($_GET['dish_id'])) {
        $dish_id = $_GET['dish_id'];
        $action = "../scripts/dishes/dish_edit.php?dish_id=" . $dish_id;
        $current_dish = "SELECT *
        FROM Dishes 
       WHERE id = $dish_id";
        $result = mysqli_query($link, $current_dish);
        if ($result) {
            $res_arr = mysqli_fetch_array($result);
        } else {
            echo "Произошла ошибка : " . mysqli_error($link);
        }
    } else {
        $action = "../scripts/dishes/dish_add.php";
    }
    ?>
    <form method="post" action="<?= $action ?>" class="form-outline mb-4" enctype="multipart/form-data">
        <h1 class="text-center">
            <?php echo isset($dish_id) ? 'Редактирование блюда' : 'Добавление блюда' ?>
        </h1>
        <div class="row">
            <div class="col-md-12">
                <label class="form-label" for="name">Название</label>
                <input type="text" name="name" placeholder="Тирамису" class="form-control"
                    value="<?php echo $res_arr['name'] ?>" required="required" />
                <label class="form-label" for="price">Cтоимость</label>
                <input type="number" name="price" placeholder="300" class="form-control"
                    value="<?php echo $res_arr['price'] ?>" required="required" />
                <label class="form-label" for="description">Описание</label>
                <textarea name="description" placeholder="Классический вкусный десерт" class="form-control"
                    required="required"><?php echo $res_arr['description'] ?></textarea>
                <label class="form-label" for="image_path">Изображение</label>
                <br>

                <input type="file" name="image_path" accept="image/*" />
            </div>
        </div>
        <input type="submit" name="add" class="btn btn-primary btn-block mb-4 mt-3"
            value="<?php echo isset($res_arr['id']) ? 'Сохранить' : 'Добавить' ?>"></input>
    </form>
</div>