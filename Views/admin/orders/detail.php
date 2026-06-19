<?php
$order = $order ?? [];
$orderDetails = $orderDetails ?? [];

$statusText = [
    'pending' => 'Chờ xác nhận',
    'confirmed' => 'Đã xác nhận',
    'shipping' => 'Đang giao',
    'delivered' => 'Hoàn thành',
    'cancelled' => 'Đã hủy',
];

$statusIcons = [
    'pending' => 'bx-time-five',
    'confirmed' => 'bx-check-shield',
    'shipping' => 'bx-package',
    'delivered' => 'bx-check-circle',
    'cancelled' => 'bx-x-circle',
];

$formatMoney = static function ($amount): string {
    return number_format((float) $amount, 0, ',', '.') . 'đ';
};

$isPaid = static function ($paymentStatus): bool {
    return in_array((string) $paymentStatus, ['1', 'paid'], true);
};

$status = (string) ($order['status'] ?? 'pending');
$status = array_key_exists($status, $statusText) ? $status : 'pending';
$paymentPaid = $isPaid($order['payment_status'] ?? 0);
$orderTotal = (float) ($order['total_price'] ?? $order['total'] ?? 0);
$orderId = $order['id'] ?? '';
$createdAt = $order['created_at'] ?? '';
$timestamp = $createdAt ? strtotime($createdAt) : false;
$displayDate = $timestamp ? date('d/m/Y H:i', $timestamp) : ($createdAt ?: '--');

$toastMap = [
    'updated' => ['type' => 'success', 'icon' => 'bx-check-circle', 'text' => 'Cập nhật trạng thái thành công'],
    'error' => ['type' => 'error', 'icon' => 'bx-error-circle', 'text' => 'Có lỗi xảy ra, vui lòng thử lại'],
];

$toast = isset($_GET['msg'], $toastMap[$_GET['msg']]) ? $toastMap[$_GET['msg']] : null;
?>

<?php if ($toast): ?>
    <div id="toast" class="toast-message <?= htmlspecialchars($toast['type']) ?>">
        <i class="bx <?= htmlspecialchars($toast['icon']) ?>"></i>
        <span><?= htmlspecialchars($toast['text']) ?></span>
    </div>
<?php endif; ?>

<div class="orders-page">

    <?php if (empty($order)): ?>
        <div class="box order-empty-box">
            <div class="empty-state">
                <i class='bx bx-receipt'></i>
                <strong>Không tìm thấy đơn hàng</strong>
                <span>Đơn hàng có thể đã bị xóa hoặc mã đơn không hợp lệ.</span>
                <a href="index.php?page=orders" class="btn-primary">
                    <i class='bx bx-arrow-back'></i>
                    <span>Quay lại danh sách</span>
                </a>
            </div>
        </div>
    <?php else: ?>

        <div class="box order-detail-header">
            <div class="box-title">
                <div>
                    <h2>Chi tiết đơn hàng #OD<?= htmlspecialchars((string) $orderId) ?></h2>
                    <span>Ngày đặt: <?= htmlspecialchars($displayDate) ?></span>
                </div>

                <a href="index.php?page=orders" class="btn-ghost text-btn">
                    <i class='bx bx-arrow-back'></i>
                    <span>Quay lại</span>
                </a>
            </div>
        </div>

        <div class="order-stats-grid detail-stats">
            <div class="order-stat-card">
                <span class="order-stat-icon <?= htmlspecialchars($status) ?>">
                    <i class="bx <?= htmlspecialchars($statusIcons[$status]) ?>"></i>
                </span>
                <div>
                    <p>Trạng thái</p>
                    <strong><?= htmlspecialchars($statusText[$status]) ?></strong>
                </div>
            </div>

            <div class="order-stat-card">
                <span class="order-stat-icon <?= $paymentPaid ? 'paid' : 'unpaid' ?>">
                    <i class='bx bx-credit-card'></i>
                </span>
                <div>
                    <p>Thanh toán</p>
                    <strong><?= $paymentPaid ? 'Đã thanh toán' : 'Chưa thanh toán' ?></strong>
                </div>
            </div>

            <div class="order-stat-card">
                <span class="order-stat-icon total"><i class='bx bx-package'></i></span>
                <div>
                    <p>Sản phẩm</p>
                    <strong><?= count($orderDetails) ?></strong>
                </div>
            </div>

            <div class="order-stat-card">
                <span class="order-stat-icon revenue"><i class='bx bx-wallet'></i></span>
                <div>
                    <p>Tổng tiền</p>
                    <strong><?= $formatMoney($orderTotal) ?></strong>
                </div>
            </div>
        </div>

        <form action="index.php?page=order-update-status" method="POST" class="box order-detail-form">

            <input type="hidden" name="id" value="<?= htmlspecialchars((string) $orderId) ?>">

            <div class="detail-section detail-grid">
                <div>
                    <div class="section-heading">
                        <i class='bx bx-user'></i>
                        <h3>Thông tin khách hàng</h3>
                    </div>

                    <dl class="detail-list">
                        <div>
                            <dt>Khách hàng</dt>
                            <dd><?= htmlspecialchars((string) ($order['name'] ?? $order['customer_name'] ?? 'Khách lẻ')) ?></dd>
                        </div>
                        <div>
                            <dt>Số điện thoại</dt>
                            <dd><?= htmlspecialchars((string) ($order['phone'] ?? 'Chưa có SĐT')) ?></dd>
                        </div>
                        <div>
                            <dt>Email</dt>
                            <dd><?= htmlspecialchars((string) ($order['email'] ?? 'Chưa có email')) ?></dd>
                        </div>
                        <div>
                            <dt>Địa chỉ nhận hàng</dt>
                            <dd><?= htmlspecialchars((string) ($order['address'] ?? 'Chưa có địa chỉ')) ?></dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <div class="section-heading">
                        <i class='bx bx-slider-alt'></i>
                        <h3>Xử lý đơn hàng</h3>
                    </div>

                    <dl class="detail-list compact">
                        <div>
                            <dt>Mã đơn</dt>
                            <dd>#OD<?= htmlspecialchars((string) $orderId) ?></dd>
                        </div>
                        <div>
                            <dt>Phương thức</dt>
                            <dd><?= htmlspecialchars((string) ($order['payment_method'] ?? 'COD')) ?></dd>
                        </div>
                    </dl>

                    <label class="status-control">
                        <span>Trạng thái đơn</span>
                        <select name="status">
                            <?php foreach ($statusText as $key => $text): ?>
                                <option value="<?= htmlspecialchars($key) ?>" <?= $status === $key ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($text) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <button type="submit" class="btn-save">
                        <i class='bx bx-save'></i>
                        <span>Cập nhật trạng thái</span>
                    </button>
                </div>
            </div>

            <div class="detail-section">
                <div class="section-heading">
                    <i class='bx bx-cart'></i>
                    <h3>Sản phẩm trong đơn</h3>
                </div>

                <div class="table-wrapper">
                    <table class="order-product-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($orderDetails as $item): ?>
                                <?php
                                    $qty = (int) ($item['qty'] ?? $item['quantity'] ?? 1);
                                    $price = (float) ($item['price'] ?? 0);
                                    $itemTotal = (float) ($item['total_price'] ?? ($price * $qty));
                                ?>
                                <tr>
                                    <td>
                                        <strong><?= htmlspecialchars((string) ($item['product_name'] ?? $item['name'] ?? 'Sản phẩm')) ?></strong>
                                    </td>
                                    <td><?= $qty ?></td>
                                    <td><?= $formatMoney($price) ?></td>
                                    <td><strong><?= $formatMoney($itemTotal) ?></strong></td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($orderDetails)): ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state compact">
                                            <i class='bx bx-package'></i>
                                            <strong>Chưa có sản phẩm trong đơn hàng</strong>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="3">Tổng cộng</td>
                                <td><?= $formatMoney($orderTotal) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="detail-section">
                <div class="section-heading">
                    <i class='bx bx-note'></i>
                    <h3>Ghi chú</h3>
                </div>

                <textarea readonly><?= htmlspecialchars((string) ($order['note'] ?? '')) ?></textarea>
            </div>

        </form>

    <?php endif; ?>

</div>

<script src="../assets/admin/js/orders.js"></script>
