<?php
if (isset($_SESSION['user_id']) && $_SESSION['user_type'] != 'admin') {
    header('Location: orders.php');
    exit;
}
?>