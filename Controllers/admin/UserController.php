<?php

class UserController
{
    public function index()
    {
        $title = 'Người dùng';
        $pageTitle = 'Quản lý người dùng';

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/users/index.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }
}