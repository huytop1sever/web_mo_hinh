<?php

class CheckoutController
{
    public function index()
    {
        require_once 'Models/Cart.php';
        require_once 'Models/Product.php';
        require_once 'Models/Order.php';

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

            if ($name === '') {
                $errors[] = 'Vui lòng nhập họ tên';
            }

            if ($phone === '') {
                $errors[] = 'Vui lòng nhập số điện thoại';
            }

            if ($address === '') {
                $errors[] = 'Vui lòng nhập địa chỉ nhận hàng';
            }

            $cart = new Cart();
            $cartItems = $cart->getItems();

            if (empty($cartItems)) {
                $errors[] = 'Giỏ hàng trống';
            }

            if (empty($errors)) {
                $productModel = new Product();

                $itemsForSave = [];
                $total = 0;

                foreach ($cartItems as $key => $item) {
                    if (is_array($item)) {
                        $productId = (int) ($item['product_id'] ?? $key);
                        $variantId = $item['product_variant_id'] ?? $item['variant_id'] ?? null;
                        $variantId = $variantId ? (int) $variantId : null;
                        $qty = (int) ($item['qty'] ?? 1);
                    } else {
                        $productId = (int) $key;
                        $variantId = null;
                        $qty = (int) $item;
                    }

                    if ($qty <= 0) {
                        continue;
                    }

                    if ($variantId) {
                        $stmt = $GLOBALS['conn']->prepare("
                            SELECT 
                                pv.id,
                                pv.product_id,
                                pv.price,
                                pv.sale_price,
                                p.title
                            FROM product_variants pv
                            INNER JOIN products p ON p.id = pv.product_id
                            WHERE pv.id = ?
                        ");
                        $stmt->execute([$variantId]);
                        $prod = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($prod) {
                            $productId = (int) $prod['product_id'];
                        }
                    } else {
                        $prod = $productModel->find($productId);
                    }

                    if (!$prod) {
                        continue;
                    }

                    $price = !empty($prod['sale_price']) && $prod['sale_price'] > 0
                        ? (float) $prod['sale_price']
                        : (float) $prod['price'];

                    $itemsForSave[$productId . '_' . ($variantId ?? 0)] = [
                        'product_id' => $productId,
                        'product_variant_id' => $variantId,
                        'qty' => $qty,
                        'price' => $price
                    ];

                    $total += $price * $qty;
                }

                if (empty($itemsForSave)) {
                    $errors[] = 'Không có sản phẩm hợp lệ trong giỏ hàng';
                }

                if (empty($errors)) {
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

                    $orderId = $orderModel->createOrderWithItems($orderData, $itemsForSave);

                    if ($orderId) {
                        $cart->clear();

                        if (ob_get_length()) {
                            ob_end_clean();
                        }

                        header('Location: index.php?page=profile');
                        exit;
                    }

                    $errors[] = 'Lưu đơn hàng thất bại, vui lòng thử lại';
                }
            }
        }

        require_once 'Views/client/checkout/index.php';
    }
}