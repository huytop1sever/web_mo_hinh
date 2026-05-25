<?php

class DashboardController
{
    public function index()
    {
        $title = 'Dashboard';
        $pageTitle = 'Dashboard';

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/dashboard/index.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }
}