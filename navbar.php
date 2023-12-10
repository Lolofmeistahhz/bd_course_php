<?php
session_start();

// Массивы с меню
$admin_menu = [
    'positions.php' => 'Должности',
    'employee.php' => 'Сотрудники',
    'halls.php' => 'Залы',
    'tables.php' => 'Cтолики',
    'dishes.php' => 'Блюда',
    'orders.php' => 'Заказы',
    'users.php' => 'Учётные записи',
    'scripts/authorize/logout.php' => 'Выйти',
];

$user_menu = [
    'orders.php' => 'Заказы',
    'scripts/authorize/logout.php' => 'Выйти',
];

$menu = ($_SESSION['user_type'] == 'admin') ? $admin_menu : $user_menu;

// Отображение меню
echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">' .
    '<div class="container">' .
    '<a class="navbar-brand" href="#">Админ-панель</a>' .
    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">' .
    '<span class="navbar-toggler-icon"></span>' .
    '</button>' .
    '<div class="collapse navbar-collapse" id="navbarNav">' .
    '<ul class="navbar-nav ms-auto">';

foreach ($menu as $url => $label) {
    echo '<li class="nav-item">' .
        '<a class="nav-link" href="' . $url . '">' . $label . '</a>' .
        '</li>';
}

echo '</ul>' .
    '</div>' .
    '</div>' .
    '</nav>';
?>
