<?php
$title = isset($emp_id) ? 'Редактирование заказа' : 'Добавление заказа';
include '../header.php';
?>
<?php
include '../scripts/authorize/auth_check.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <?php

    $action = "../scripts/orders/order_add.php";
    ?>
    <form method="post" action="<?= $action ?>" class="form-outline mb-4">
        <h1 class="text-center">
            <?php echo isset($emp_id) ? 'Редактирование заказа' : 'Добавление заказа' ?>
        </h1>
        <div class="row mt-3" style="max-width:800px;">
            <div class="col-md-6 mt-3">
                <h5>Информация о заказе </h1>
                    <label class="form-label" for="fullname">Ф.И.О. сотрудника</label>
                    <select class="form-select" style="min-width:100%;" name="fullname" required="required">

                        <?php include '../scripts/orders/order_filter.php'; ?>
                    </select>
                    <label class="form-label" for="number">Номер столика</label>
                    <select class="form-select" style="min-width:100%;" name="number" required="required">

                        <?php include '../scripts/orders/order_filter_2.php'; ?>
                    </select>
                    <label class="form-label" for="order_date">Дата и время заказа</label>
                    <input type="datetime-local" name="order_date-time" class="form-control"
                        value="<?php echo isset($res_arr['order_date']) ?>" />

            </div>
            <div class="col-md-6 mt-3">
                <h5>Заказанные блюда </h5>
                <div id="dishContainer">
                    <label for="dish1">Блюдо № 1</label><br>
                    <select class="form-select" style="min-width:100%;" name="dish1" required="required">

                        <?php include '../scripts/orders/order_filter_3.php'; ?>
                    </select>
                </div>

            </div>
        </div>
        <a id="addButton" class="btn col-md-12 btn-secondary mt-3">Добавить блюдо</a>
        <input type="submit" name="add" class="btn btn-primary btn-block mb-4 mt-3"
            value="<?php echo isset($res_arr['id']) ? 'Сохранить' : 'Добавить' ?>"></input>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            const dishContainer = $("#dishContainer");

            let dishCounter = 2;

            function addDishField() {
                const dishField = `
                <label for="dish${dishCounter}">Блюдо №${dishCounter}</label><br>
                <select class="form-select" style="min-width:100%;" name="dish${dishCounter}" required="required">

                    <?php include '../scripts/orders/order_filter_3.php'; ?>
                </select>`;
                dishContainer.append(dishField);
                dishCounter++;
            }

            $("#addButton").click(function () {
                const currentDishCount = dishContainer.find('.form-select').length;
                if (currentDishCount < 15) {
                    addDishField();
                } else {
                    alert('Вы достигли максимального количества карточек 15.');
                }
            });
        });
    </script>
</div>