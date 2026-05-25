<?php

class OrderController
{
    public function index()
    {
        $title = 'Đơn hàng';
        $pageTitle = 'Quản lý đơn hàng';

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/orders/index.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }
}