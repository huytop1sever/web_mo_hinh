<?php

class CartController
{
    public function index()
    {
        require_once 'Views/client/cart/index.php';
    }

    private function requireLogin()
    {
        if (empty($_SESSION['user'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để mua hàng',
                'login_required' => true
            ]);
            exit;
        }
    }

    public function add()
    {
        $this->requireLogin();
        require_once 'Models/Cart.php';

        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm'
            ]);
            return;
        }

        $cart = new Cart();
        $cart->add($id, 1);

        echo json_encode([
            'success' => true,
            'message' => 'Đã thêm vào giỏ hàng',
            'count' => $cart->count()
        ]);
    }

    public function remove()
    {
        $this->requireLogin();
        require_once 'Models/Cart.php';

        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm'
            ]);
            return;
        }

        $cart = new Cart();
        $cart->remove($id);

        echo json_encode([
            'success' => true,
            'message' => 'Đã xóa sản phẩm khỏi giỏ hàng',
            'count' => $cart->count()
        ]);
    }

    public function update()
    {
        $this->requireLogin();
        require_once 'Models/Cart.php';

        $id = $_POST['id'] ?? null;
        $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : null;

        if (!$id || $qty === null || $qty < 1) {
            echo json_encode([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ'
            ]);
            return;
        }

        $cart = new Cart();
        $cart->update($id, $qty);

        echo json_encode([
            'success' => true,
            'message' => 'Cập nhật giỏ hàng thành công',
            'count' => $cart->count()
        ]);
    }
}