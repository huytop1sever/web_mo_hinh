<?php

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

    case 'products':
        require_once '../Controllers/admin/ProductController.php';
        break;

    case 'users':
        require_once '../Controllers/admin/UserController.php';
        break;

    case 'orders':
        require_once '../Controllers/admin/OrderController.php';
        break;

    default:
        include '../Views/admin/layouts/header.php';
        include '../Views/admin/layouts/sidebar.php';
        include '../Views/admin/dashboard.php';
        include '../Views/admin/layouts/footer.php';
        break;
}