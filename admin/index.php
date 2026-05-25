<?php

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

    case 'products':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->index();

        break;

    case 'categories':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->index();

        break;

    case 'dashboard':

        require_once '../Controllers/admin/DashboardController.php';

        $controller = new DashboardController();
        $controller->index();

        break;

    default:

        require_once '../Controllers/admin/DashboardController.php';

        $controller = new DashboardController();
        $controller->index();

        break;
}
