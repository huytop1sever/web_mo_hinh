<?php

class CheckoutController
{
    public function index()
    {
        // require necessary models
        require_once 'Models/Cart.php';
        require_once 'Models/Product.php';
        require_once 'Models/Order.php';

        // Ensure user is logged in (index.php handles most cases)
        if (empty($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $note = trim($_POST['note'] ?? '');
            $payment = trim($_POST['payment'] ?? 'COD');

            if ($name === '') $errors[] = 'Vui lòng nhập họ tên';
            if ($phone === '') $errors[] = 'Vui lòng nhập số điện thoại';
            if ($address === '') $errors[] = 'Vui lòng nhập địa chỉ nhận hàng';

            $cart = new Cart();
            $cartItems = $cart->getItems();

            if (empty($cartItems)) {
                $errors[] = 'Giỏ hàng trống';
            }

            if (empty($errors)) {
                $productModel = new Product();

                $itemsForSave = [];
                $total = 0;
                foreach ($cartItems as $productId => $qty) {
                    $prod = $productModel->find($productId);
                    if (!$prod) continue;
                    $price = isset($prod['sale_price']) && $prod['sale_price'] > 0 ? $prod['sale_price'] : $prod['price'];
                    $itemsForSave[$productId] = $qty;
                    // attach price to items array for createOrderWithItems convenience
                    $itemsForSave[$productId] = ['qty' => $qty, 'price' => (float)$price];
                    $total += ((float)$price) * (int)$qty;
                }

                $orderModel = new Order();
                $orderData = [
                    'user_id' => $_SESSION['user']['id'],
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                    'total_price' => $total,
                    'payment_method' => $payment,
                    'payment_status' => ($payment === 'COD') ? 'unpaid' : 'paid',
                    'status' => 'pending',
                    'note' => $note
                ];

                // create order and details
                $orderId = $orderModel->createOrderWithItems($orderData, $itemsForSave);

                if ($orderId) {
                    // clear cart
                    $cart->clear();
                    // redirect to profile/orders
                    ob_end_clean();
                    header('Location: index.php?page=profile');
                    exit;
                } else {
                    $errors[] = 'Lưu đơn hàng thất bại, vui lòng thử lại';
                }
            }
        }

        require_once 'Views/client/checkout/index.php';
    }
}