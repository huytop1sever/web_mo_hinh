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

$status = (string) ($order['status'] ?? 'pending');
$status = array_key_exists($status, $statusText) ? $status : 'pending';

$orderId = $order['id'] ?? '';
$orderTotal = (float) ($order['total_price'] ?? $order['total'] ?? 0);

$createdAt = $order['created_at'] ?? '';
$timestamp = $createdAt ? strtotime($createdAt) : false;
$displayDate = $timestamp ? date('d/m/Y H:i', $timestamp) : '--';

$paymentStatus = (string) ($order['payment_status'] ?? 'unpaid');
$paymentPaid = in_array($paymentStatus, ['1', 'paid'], true);

$statusFlow = ['pending', 'confirmed', 'shipping', 'delivered'];
$currentIndex = array_search($status, $statusFlow, true);

if ($status === 'pending') {
    $allowedStatus = ['pending', 'confirmed', 'cancelled'];
} elseif ($status === 'confirmed') {
    $allowedStatus = ['confirmed', 'shipping', 'cancelled'];
} elseif ($status === 'shipping') {
    $allowedStatus = ['shipping', 'delivered'];
} elseif ($status === 'delivered') {
    $allowedStatus = ['delivered'];
} else {
    $allowedStatus = ['cancelled'];
}

$toastMap = [
    'updated' => ['type' => 'success', 'icon' => 'bx-check-circle', 'text' => 'Cập nhật trạng thái thành công'],
    'error' => ['type' => 'error', 'icon' => 'bx-error-circle', 'text' => 'Không thể cập nhật trạng thái'],
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

        <div class="box">
            <div class="empty-state">
                <i class="bx bx-receipt"></i>
                <strong>Không tìm thấy đơn hàng</strong>
                <a href="index.php?page=orders" class="btn-primary">Quay lại danh sách</a>
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
                    <i class="bx bx-arrow-back"></i>
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
                    <i class="bx bx-credit-card"></i>
                </span>
                <div>
                    <p>Thanh toán</p>
                    <strong><?= $paymentPaid ? 'Đã thanh toán' : 'Chưa thanh toán' ?></strong>
                </div>
            </div>

            <div class="order-stat-card">
                <span class="order-stat-icon total">
                    <i class="bx bx-package"></i>
                </span>
                <div>
                    <p>Sản phẩm</p>
                    <strong><?= count($orderDetails) ?></strong>
                </div>
            </div>

            <div class="order-stat-card">
                <span class="order-stat-icon revenue">
                    <i class="bx bx-wallet"></i>
                </span>
                <div>
                    <p>Tổng tiền</p>
                    <strong><?= $formatMoney($orderTotal) ?></strong>
                </div>
            </div>
        </div>

        <form action="index.php?page=order-update-status" method="POST" class="box order-detail-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars((string) $orderId) ?>">

            <div class="detail-section">
                <div class="section-heading">
                    <i class="bx bx-git-branch"></i>
                    <h3>Tiến trình đơn hàng</h3>
                </div>

                <div class="order-step-box">
                    <?php foreach ($statusFlow as $index => $step): ?>
                        <div class="order-step <?= ($currentIndex !== false && $index <= $currentIndex) ? 'active' : '' ?>">
                            <span><?= $index + 1 ?></span>
                            <p><?= htmlspecialchars($statusText[$step]) ?></p>
                        </div>
                    <?php endforeach; ?>

                    <?php if ($status === 'cancelled'): ?>
                        <div class="order-step cancelled active">
                            <span>!</span>
                            <p>Đã hủy</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="detail-section detail-grid">
                <div>
                    <div class="section-heading">
                        <i class="bx bx-user"></i>
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
                            <dt>Địa chỉ</dt>
                            <dd><?= htmlspecialchars((string) ($order['address'] ?? 'Chưa có địa chỉ')) ?></dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <div class="section-heading">
                        <i class="bx bx-slider-alt"></i>
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

                    <div class="status-button-group">
                        <?php foreach ($allowedStatus as $key): ?>
                            <button
                                type="submit"
                                name="status"
                                value="<?= htmlspecialchars($key) ?>"
                                class="status-action-btn <?= $status === $key ? 'active' : '' ?> <?= htmlspecialchars($key) ?>"
                                <?= $status === $key ? 'disabled' : '' ?>>
                                <i class="bx <?= htmlspecialchars($statusIcons[$key]) ?>"></i>
                                <span><?= htmlspecialchars($statusText[$key]) ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <div class="section-heading">
                    <i class="bx bx-cart"></i>
                    <h3>Sản phẩm trong đơn</h3>
                </div>

                <div class="table-wrapper">
                    <table class="order-product-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Biến thể</th>
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

                                $variantName = $item['variant_name'] ?? '';

                                $variantPrice = (float) (
                                    !empty($item['variant_sale_price']) && $item['variant_sale_price'] > 0
                                        ? $item['variant_sale_price']
                                        : ($item['variant_price'] ?? 0)
                                );
                                ?>

                                <tr>
                                    <td>
                                        <strong>
                                            <?= htmlspecialchars((string) ($item['product_name'] ?? 'Sản phẩm')) ?>
                                        </strong>
                                    </td>

                                    <td>
                                        <?php if (!empty($variantName)): ?>
                                            <strong><?= htmlspecialchars($variantName) ?></strong>

                                            <?php if ($variantPrice > 0): ?>
                                                <br>
                                                <small>Giá biến thể: <?= $formatMoney($variantPrice) ?></small>
                                            <?php endif; ?>

                                        <?php else: ?>
                                            Không có biến thể
                                        <?php endif; ?>
                                    </td>

                                    <td><?= $qty ?></td>
                                    <td><?= $formatMoney($price) ?></td>
                                    <td><strong><?= $formatMoney($itemTotal) ?></strong></td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($orderDetails)): ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state compact">
                                            <i class="bx bx-package"></i>
                                            <strong>Chưa có sản phẩm trong đơn hàng</strong>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="4">Tổng cộng</td>
                                <td><?= $formatMoney($orderTotal) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="detail-section">
                <div class="section-heading">
                    <i class="bx bx-note"></i>
                    <h3>Ghi chú</h3>
                </div>

                <textarea readonly><?= htmlspecialchars((string) ($order['note'] ?? '')) ?></textarea>
            </div>
        </form>

    <?php endif; ?>

</div>