<?php

class DashboardController
{
    public function index()
    {
        $title = 'Dashboard';
        $pageTitle = 'Dashboard';

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';

        include_once '../Views/admin/dashboard/index.php';

        include_once '../Views/admin/layouts/footer.php';
    }
}