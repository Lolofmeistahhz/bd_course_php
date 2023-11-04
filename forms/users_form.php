<?php
$title = isset($hall_id) ? 'Редактирование учётной записи' : 'Добавление учётной записи';
include '../header.php';
?>
<?php
include '../scripts/authorize/auth_check.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <?php
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $action = "../scripts/users/users_edit.php?user_id=" . $user_id;
        $current_user = "SELECT * FROM Users WHERE id = $user_id";
        $result = mysqli_query($link, $current_user);
        if ($result) {
            $res_arr = mysqli_fetch_array($result);
        } else {
            echo "Произошла ошибка : " . mysqli_error($link);
        }
    } else {
        $action = "../scripts/users/users_add.php";
    }
    ?>
    <form method="post" action="<?= $action ?>" class="form-outline mb-4">
        <h1 class="text-center">
            <?php echo isset($hall_id) ? 'Редактирование учётной записи' : 'Добавление учётной записи' ?>
        </h1>
        <div class="row">

            <div class="col-md-12">
                <label class="form-label" for="name">Логин</label>
                <input type="text" name="login" placeholder="user_test001" class="form-control"
                    value="<?php echo $res_arr['login'] ?>" required="required" />
                <label class="form-label" for="description">Пароль</label>
                <input type="password" placeholder="***" name="password_hash"
                    value="<?php echo $res_arr['password_hash'] ?>" class="form-control" />
            </div>

        </div>
        <input type="submit" name="add" class="btn btn-primary btn-block mb-4 mt-3"
            value="<?php echo isset($res_arr['id']) ? 'Сохранить' : 'Добавить' ?>"></input>
    </form>
</div>