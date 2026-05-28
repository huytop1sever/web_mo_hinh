<?php

class CartController
{
    public function index()
    {
        require_once 'Views/client/cart/index.php';
    }

    public function add()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm'
            ]);
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }

        echo json_encode([
            'success' => true,
            'message' => 'Đã thêm vào giỏ hàng'
        ]);
    }
}