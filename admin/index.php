<?php

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

   
    default:

        require_once '../Controllers/admin/DashboardController.php';

        $controller = new DashboardController();
        $controller->index();

        break;
}