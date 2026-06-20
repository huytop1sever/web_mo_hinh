<?php

class DashboardController
{
    public function index()
    {
        $title = 'Dashboard';
        $pageTitle = 'Dashboard';

        $orderModel = new Order();
        $productModel = new Product();
        $userModel = new User();

        $totalRevenue = $orderModel->getRevenueForDisplay();
        $totalOrders = $orderModel->countOrders();
        $totalUsers = (int) $userModel->getAllTotal();
        $totalProducts = (int) $productModel->getAllTotal();
        $newOrders = $orderModel->getNewOrders(10);

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';

        include_once '../Views/admin/dashboard/index.php';

        include_once '../Views/admin/layouts/footer.php';
    }
}
