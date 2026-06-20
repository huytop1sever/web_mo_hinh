<?php require_once 'Views/client/layouts/Header.php'; ?>
<?php
require_once 'Models/Cart.php';
require_once 'Models/Product.php';

$cartModel = new Cart();
$cartItems = $cartModel->getItems();
$productModel = new Product();

$user = $_SESSION['user'] ?? null;
?>

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Thanh toán</h1>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">

        <form action="index.php?page=checkout" method="post">

            <div class="row g-5">

                <div class="col-md-12 col-lg-6 col-xl-7">

                    <h2 class="mb-4">Thông tin nhận hàng</h2>

                    <div class="form-item mb-3">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập họ tên" value="<?= htmlspecialchars($user['name'] ?? '') ?>">
                    </div>

                    <div class="form-item mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                    </div>

                    <div class="form-item mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Nhập email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" readonly>
                    </div>

                    <div class="form-item mb-3">
                        <label class="form-label">Địa chỉ nhận hàng</label>
                        <input type="text" name="address" class="form-control" placeholder="Số nhà, đường, phường/xã, quận/huyện" value="<?= htmlspecialchars($user['address'] ?? '') ?>">
                    </div>

                    <div class="form-item mb-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea name="note" class="form-control" rows="5" placeholder="Ghi chú đơn hàng"><?= htmlspecialchars($_POST['note'] ?? '') ?></textarea>
                    </div>

                </div>

                <div class="col-md-12 col-lg-6 col-xl-5">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>SL</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $subtotal = 0;
                                if (!empty($cartItems)):
                                    foreach ($cartItems as $productId => $quantity):
                                        $product = $productModel->find($productId);
                                        if (!$product) continue;
                                        $price = (isset($product['sale_price']) && $product['sale_price'] > 0) ? $product['sale_price'] : $product['price'];
                                        $lineTotal = $price * (int)$quantity;
                                        $subtotal += $lineTotal;
                                ?>
                                <tr>
                                    <td>
                                        <img src="<?= htmlspecialchars($product['image'] ?? 'assets/client/img/no-image.png') ?>"
                                             class="img-fluid rounded-circle"
                                             style="width:70px;height:70px;object-fit:cover;">
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4"><?= htmlspecialchars($product['title'] ?? $product['name'] ?? '') ?></p>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4"><?= number_format($price, 0, ',', '.') ?>đ</p>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4"><?= (int)$quantity ?></p>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4"><?= number_format($lineTotal, 0, ',', '.') ?>đ</p>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                else:
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center">Giỏ hàng trống</td>
                                </tr>
                                <?php endif; ?>

                                <tr>
                                    <td colspan="4">
                                        <h5 class="mt-4">Tạm tính</h5>
                                    </td>

                                    <td>
                                        <p class="mt-4"><?= number_format($subtotal, 0, ',', '.') ?>đ</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4">
                                        <h5>Phí vận chuyển</h5>
                                    </td>

                                    <td>
                                        <p>Miễn phí</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4">
                                        <h5>Tổng cộng</h5>
                                    </td>

                                    <td>
                                        <h5><?= number_format($subtotal, 0, ',', '.') ?>đ</h5>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start">
                                <input type="radio"
                                       class="form-check-input"
                                       name="payment"
                                       id="cod"
                                       checked>

                                <label class="form-check-label" for="cod">
                                    Thanh toán khi nhận hàng
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start">
                                <input type="radio"
                                       class="form-check-input"
                                       name="payment"
                                       id="bank">

                                <label class="form-check-label" for="bank">
                                    Chuyển khoản ngân hàng
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="submit"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">
                            Đặt hàng
                        </button>
                    </div>

                </div>

            </div>

        </form>

    </div>
</div>

<?php require_once 'Views/client/layouts/Footer.php'; ?>