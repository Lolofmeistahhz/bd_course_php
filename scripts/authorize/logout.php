<?php
session_start();
$_SESSION = array(); // Очистить сессию
session_destroy(); // Уничтожить сессию
header('Location: ../../index.php');
exit;
?>