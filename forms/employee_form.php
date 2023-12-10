<?php
$title = isset($emp_id) ? 'Редактирование сотрудника' : 'Добавление сотрудника';
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
    if (isset($_GET['emp_id'])) {
        $emp_id = $_GET['emp_id'];
        $action = "../scripts/employee/employee_edit.php?emp_id=" . $emp_id;
        $current_employee = "SELECT Employee.id, Employee.fullname, Positions.name, Employee.email, Employee.phone, Employee.address 
        FROM Employee 
        INNER JOIN Positions 
        ON Positions.id = Employee.pos_id WHERE Employee.id = $emp_id"; 
        $result = mysqli_query($link, $current_employee);
        if ($result) {
            $res_arr = mysqli_fetch_array($result);
        } else {
            echo "Произошла ошибка : " . mysqli_error($link);
        }
    } else {
        $action = "../scripts/employee/employee_add.php";
    }
    ?>
    <form method="post" action="<?= $action ?>" class="form-outline mb-4">
        <h1 class="text-center">
            <?php echo isset($emp_id) ? 'Редактирование сотрудника' : 'Добавление сотрудника' ?>
        </h1>
        <div class="row">
            <div class="col-md-6">
                <label class="form-label" for="fullname">Ф.И.О. официанта</label>
                <input type="text" name="fullname" placeholder="Ф.И.О." class="form-control"
                    value="<?php echo $res_arr['fullname'] ?>" required="required" />
                <label class="form-label" for="email">Email сотрудника</label>
                <input type="text" name="email" placeholder="email" class="form-control"
                    value="<?php echo $res_arr['email'] ?>" required="required" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="phone">Номер телефона</label>
                <input type="text" name="phone" placeholder="Телефон." class="form-control"
                    value="<?php echo $res_arr['phone'] ?>" required="required" />
                <label class="form-label" for="address">Адрес сотрудника</label>
                <input type="text" name="address" placeholder="Адрес проживания" class="form-control"
                    value="<?php echo $res_arr['address'] ?>" required="required" />
            </div>
        </div>
        <label class="form-label mt-3" for="position">Должность сотрудника</label>
        <select class="form-select" style="min-width:100%;" name="position" required="required">

            <?php include '../scripts/employee/employee_filter.php'; ?>
        </select>
        <br>
        <input type="submit" name="add" class="btn btn-primary btn-block mb-4 mt-3"
            value="<?php echo isset($res_arr['id']) ? 'Сохранить' : 'Добавить' ?>"></input>
    </form>
</div>