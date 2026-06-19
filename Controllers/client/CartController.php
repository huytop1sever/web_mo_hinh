<?php

require_once 'Models/Cart.php';

class CartController
{
    private function getUserId()
    {
        return $_SESSION['user']['id'] ?? $_SESSION['user_id'] ?? 0;
    }

    public function index()
    {
        $userId = $this->getUserId();

        if ($userId <= 0) {
            header('Location: index.php?page=login');
            exit;
        }

        $cartModel = new Cart();
        $cartItems = $cartModel->getByUser($userId);

        require_once 'Views/client/cart/index.php';
    }

    public function add()
    {
        $userId = $this->getUserId();

        if ($userId <= 0) {
            header('Location: index.php?page=login');
            exit;
        }

        $productId = (int)($_GET['id'] ?? 0);
        $variantId = (int)($_GET['variant_id'] ?? 0);
        $qty = (int)($_GET['qty'] ?? 1);

        if ($productId <= 0 || $variantId <= 0) {
            header('Location: index.php?page=cart&status=error');
            exit;
        }

        if ($qty <= 0) {
            $qty = 1;
        }

        $cartModel = new Cart();
        $cartModel->add($userId, $productId, $variantId, $qty);

        header('Location: index.php?page=cart&status=success');
        exit;
    }

    public function delete()
    {
        $userId = $this->getUserId();
        $cartId = (int)($_GET['id'] ?? 0);

        if ($userId <= 0) {
            header('Location: index.php?page=login');
            exit;
        }

        if ($cartId > 0) {
            $cartModel = new Cart();
            $cartModel->delete($cartId, $userId);
        }

        header('Location: index.php?page=cart&status=deleted');
        exit;
    }
}