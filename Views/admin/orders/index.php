<?php
$orders = $orders ?? [];

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

$getTotal = static function (array $order): float {
    return (float) ($order['total_price'] ?? $order['total'] ?? 0);
};

$getStatus = static function (array $order) use ($statusText): string {
    $status = (string) ($order['status'] ?? 'pending');
    return array_key_exists($status, $statusText) ? $status : 'pending';
};

$isPaid = static function ($paymentStatus): bool {
    return in_array((string) $paymentStatus, ['1', 'paid'], true);
};

$keyword = trim((string) ($_GET['keyword'] ?? ''));
$filterStatus = (string) ($_GET['status'] ?? '');

$statusCounts = array_fill_keys(array_keys($statusText), 0);
$totalRevenue = 0;
$paidCount = 0;

foreach ($orders as $order) {
    $statusCounts[$getStatus($order)]++;
    $totalRevenue += $getTotal($order);

    if ($isPaid($order['payment_status'] ?? 0)) {
        $paidCount++;
    }
}

$filteredOrders = array_values(array_filter($orders, static function (array $order) use ($keyword, $filterStatus, $getStatus): bool {
    $status = $getStatus($order);

    if ($filterStatus !== '' && $status !== $filterStatus) {
        return false;
    }

    if ($keyword === '') {
        return true;
    }

    $haystack = implode(' ', [
        '#OD' . ($order['id'] ?? ''),
        $order['name'] ?? '',
        $order['customer_name'] ?? '',
        $order['phone'] ?? '',
        $order['email'] ?? '',
    ]);

    return stripos($haystack, $keyword) !== false;
}));

$toastMap = [
    'deleted' => ['type' => 'success', 'icon' => 'bx-check-circle', 'text' => 'Xóa đơn hàng thành công'],
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

    <div class="order-stats-grid">
        <div class="order-stat-card">
            <span class="order-stat-icon total"><i class='bx bx-receipt'></i></span>
            <div>
                <p>Tổng đơn</p>
                <strong><?= count($orders) ?></strong>
            </div>
        </div>

        <div class="order-stat-card">
            <span class="order-stat-icon pending"><i class='bx bx-time-five'></i></span>
            <div>
                <p>Chờ xử lý</p>
                <strong><?= $statusCounts['pending'] ?></strong>
            </div>
        </div>

        <div class="order-stat-card">
            <span class="order-stat-icon paid"><i class='bx bx-credit-card'></i></span>
            <div>
                <p>Đã thanh toán</p>
                <strong><?= $paidCount ?></strong>
            </div>
        </div>

        <div class="order-stat-card">
            <span class="order-stat-icon revenue"><i class='bx bx-wallet'></i></span>
            <div>
                <p>Doanh thu</p>
                <strong><?= $formatMoney($totalRevenue) ?></strong>
            </div>
        </div>
    </div>

    <div class="box order-list-box">

        <div class="box-title">
            <div>
                <h2>Danh sách đơn hàng</h2>
                <span><?= count($filteredOrders) ?> đơn đang hiển thị</span>
            </div>

            <a href="index.php?page=orders" class="btn-ghost" title="Làm mới">
                <i class='bx bx-refresh'></i>
            </a>
        </div>

        <form method="GET" class="order-filter-form">
            <input type="hidden" name="page" value="orders">

            <label class="order-search-field">
                <i class='bx bx-search'></i>
                <input
                    type="search"
                    name="keyword"
                    value="<?= htmlspecialchars($keyword) ?>"
                    placeholder="Tìm mã đơn, khách hàng, SĐT"
                >
            </label>

            <select name="status">
                <option value="">Tất cả trạng thái</option>
                <?php foreach ($statusText as $key => $label): ?>
                    <option value="<?= htmlspecialchars($key) ?>" <?= $filterStatus === $key ? 'selected' : '' ?>>
                        <?= htmlspecialchars($label) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn-primary">
                <i class='bx bx-filter-alt'></i>
                <span>Lọc</span>
            </button>

            <?php if ($keyword !== '' || $filterStatus !== ''): ?>
                <a href="index.php?page=orders" class="btn-reset">
                    <i class='bx bx-x'></i>
                    <span>Bỏ lọc</span>
                </a>
            <?php endif; ?>
        </form>

        <div class="table-wrapper order-table-wrapper">

            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($filteredOrders as $order): ?>
                        <?php
                            $status = $getStatus($order);
                            $customerName = $order['name'] ?? $order['customer_name'] ?? 'Khách lẻ';
                            $phone = $order['phone'] ?? '';
                            $createdAt = $order['created_at'] ?? '';
                            $timestamp = $createdAt ? strtotime($createdAt) : false;
                            $displayDate = $timestamp ? date('d/m/Y H:i', $timestamp) : ($createdAt ?: '--');
                        ?>
                        <tr>
                            <td>
                                <strong class="order-code">#OD<?= htmlspecialchars((string) ($order['id'] ?? '')) ?></strong>
                            </td>

                            <td>
                                <div class="customer-cell">
                                    <strong><?= htmlspecialchars((string) $customerName) ?></strong>
                                    <span><?= htmlspecialchars((string) ($phone ?: 'Chưa có SĐT')) ?></span>
                                </div>
                            </td>

                            <td>
                                <strong class="order-money"><?= $formatMoney($getTotal($order)) ?></strong>
                            </td>

                            <td>
                                <?php if ($isPaid($order['payment_status'] ?? 0)): ?>
                                    <span class="payment paid">
                                        <i class='bx bx-check'></i>
                                        Đã thanh toán
                                    </span>
                                <?php else: ?>
                                    <span class="payment unpaid">
                                        <i class='bx bx-time'></i>
                                        Chưa thanh toán
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <span class="status <?= htmlspecialchars($status) ?>">
                                    <i class="bx <?= htmlspecialchars($statusIcons[$status]) ?>"></i>
                                    <?= htmlspecialchars($statusText[$status]) ?>
                                </span>
                            </td>

                            <td><?= htmlspecialchars($displayDate) ?></td>

                            <td>
                                <div class="table-actions">

                                    <a
                                        class="action-btn view"
                                        href="index.php?page=order-detail&id=<?= urlencode((string) ($order['id'] ?? '')) ?>"
                                        title="Xem chi tiết"
                                    >
                                        <i class='bx bx-show'></i>
                                    </a>

                                    <a
                                        class="action-btn delete"
                                        href="index.php?page=order-delete&id=<?= urlencode((string) ($order['id'] ?? '')) ?>"
                                        onclick="return openOrderConfirmModal(this)"
                                        title="Xóa đơn hàng"
                                    >
                                        <i class='bx bx-trash'></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($filteredOrders)): ?>
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class='bx bx-receipt'></i>
                                    <strong><?= empty($orders) ? 'Chưa có đơn hàng' : 'Không tìm thấy đơn hàng phù hợp' ?></strong>
                                    <span><?= empty($orders) ? 'Đơn hàng mới sẽ xuất hiện tại đây.' : 'Thử đổi từ khóa hoặc trạng thái lọc.' ?></span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>

    </div>

</div>

<div class="modal order-confirm-modal" id="confirmModal">

    <div class="confirm-modal">

        <i class='bx bx-trash'></i>

        <h3>Xóa đơn hàng?</h3>

        <p>Đơn hàng sẽ bị xóa khỏi hệ thống. Thao tác này không thể hoàn tác.</p>

        <div class="confirm-actions">
            <button type="button" class="btn-cancel" onclick="closeOrderConfirmModal()">
                Hủy
            </button>

            <a href="#" id="confirmBtn" class="btn-danger">
                Xóa đơn hàng
            </a>
        </div>

    </div>

</div>

<script src="../assets/admin/js/orders.js"></script>
