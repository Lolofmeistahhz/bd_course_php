<!DOCTYPE html>
<html lang="ru">
<?php
$title = "Авторизация";
include 'header.php';
?>
<?php
include 'scripts/authorize/authorize.php';
?>

<body>
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <form method="post" action="" class="auth-form">
      <h1 class="text-center">Авторизация</h1>
      <div class="form-outline mb-4">
        <label class="form-label" for="login">Имя пользователя</label>
        <input type="text" name="login" placeholder="Имя пользователя..." class="form-control" required="required" />
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="password" required="required">Пароль</label>
        <input type="password" name="password_hash" class="form-control" />
      </div>
      <input type="submit" name="enter" class="btn btn-primary btn-block mb-4" value="Вход"></input>
    </form>
  </div>
  </div>
</body>

</html>