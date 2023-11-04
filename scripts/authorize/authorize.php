<?php
session_start();
if (isset($_POST['enter'])) {
    $login = stripslashes(htmlspecialchars(trim($_POST['login'])));
    $password = trim($_POST['password_hash']);

    if (!empty($login) && !empty($password)) {

        $sql = "SELECT `id`, `login`, `password_hash` FROM `Users` where `login`='$login'";
        $result = mysqli_query($link, $sql);

        if ($result) {
            $row = mysqli_num_rows($result);
            if ($row == 1) {
                $row = mysqli_fetch_assoc($result);
                $stored_hash = $row['password_hash'];

                if (password_verify($password, $stored_hash)) {
                    echo "Успешно авторизованы";
                    $_SESSION['user_id'] = $row['id'];
                    header('Location: employee.php');
                } else {
                    echo "Ошибка авторизации";
                }
            } else {
                echo "Ошибка авторизации";
            }
        } else {
            echo "Ошибка: " . mysqli_error($link);
        }
    } else {
        echo "Пожалуйста, заполните все поля";
    }
}
mysqli_close($link);
?>
