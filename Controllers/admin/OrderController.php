<?php

class OrderController
{
    public function index()
    {
        $title = 'Quản lý đơn hàng';
        $pageTitle = 'Đơn hàng';

        $orderModel = new Order();
        $orders = $orderModel->getAll();

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';
        include_once '../Views/admin/orders/index.php';
        include_once '../Views/admin/layouts/footer.php';
    }

    public function detail()
    {
        $id = $_GET['id'] ?? 0;

        $title = 'Chi tiết đơn hàng';
        $pageTitle = 'Chi tiết đơn hàng';

        $orderModel = new Order();

        $order = $orderModel->find($id);
        $orderDetails = $orderModel->getOrderDetails($id);

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';
        include_once '../Views/admin/orders/detail.php';
        include_once '../Views/admin/layouts/footer.php';
    }

    public function updateStatus()
    {
        $id = $_POST['id'] ?? 0;
        $status = $_POST['status'] ?? '';

        if ($id && $status !== '') {
            $orderModel = new Order();
            $orderModel->updateStatus($id, $status);

            header('Location: index.php?page=order-detail&id=' . $id . '&msg=updated');
            exit;
        }

        header('Location: index.php?page=orders&msg=error');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? 0;

        if ($id) {
            $orderModel = new Order();
            $orderModel->delete($id);

            header('Location: index.php?page=orders&msg=deleted');
            exit;
        }

        header('Location: index.php?page=orders&msg=error');
        exit;
    }
}
