<!DOCTYPE html>
<html lang="ru">
<?php
$title = "Должности";
include 'header.php';
?>
<?php
include 'scripts/authorize/auth_check.php';
?>
<?php
include 'scripts/authorize/user_type_check.php';
?>
<?php
include 'navbar.php';
?>

<body>
    <div class="container d-flex flex-column justify-content-center align-items-center mt-3" style="min-height: 75vh;">
        <div class="row mb-3">
            <div class="col-md-10">
                <form action="" method="POST" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Поиск" name="search"
                            value="<?= $_POST['search']; ?>">
                        <select class='form-select' name='sort' value='<?= $_POST['sort']; ?>'>
                            <option selected value="">Сортировать</option>
                            <option value="ASC">По возрастанию</option>
                            <option  value="DESC">По убыванию</option>

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
                <button class="btn btn-primary" onclick="location.href='forms/position_form.php'">Добавить</button>
            </div>
        </div>
        <?php
        include 'scripts/positions/position_info.php';
        ?>
        <script>
            document.querySelector('input[name="reset"]').addEventListener('click', function () {
                document.querySelector('input[name="search"]').value = '';
                document.querySelector('input[name="sort"]').value = '';
            });
        </script>
    </div>
</body>

</html>