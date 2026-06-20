<?php

$title = 'Dashboard';
$pageTitle = 'Dashboard';

include_once __DIR__ . '/../layouts/header.php';
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../layouts/navbar.php';

?>

<?php
$formatMoney = static function ($amount): string {
    return number_format((float) $amount, 0, ',', '.') . 'đ';
};

$statusMap = [
    'pending' => 'Chờ xử lý',
    'confirmed' => 'Đã xác nhận',
    'shipping' => 'Đang giao',
    'delivered' => 'Đã giao',
    'cancelled' => 'Đã hủy',
];
?>

<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="card-top">
            <h3>Tổng doanh thu</h3>
            <i class='bx bx-dollar-circle'></i>
        </div>
        <p><?= htmlspecialchars($formatMoney($totalRevenue ?? 0)) ?></p>
    </div>

    <div class="dashboard-card">
        <div class="card-top">
            <h3>Đơn hàng</h3>
            <i class='bx bx-cart'></i>
        </div>
        <p><?= htmlspecialchars((string) ($totalOrders ?? 0)) ?></p>
    </div>

    <div class="dashboard-card">
        <div class="card-top">
            <h3>Người dùng</h3>
            <i class='bx bx-user'></i>
        </div>
        <p><?= htmlspecialchars((string) ($totalUsers ?? 0)) ?></p>
    </div>

    <div class="dashboard-card">
        <div class="card-top">
            <h3>Sản phẩm</h3>
            <i class='bx bx-package'></i>
        </div>
        <p><?= htmlspecialchars((string) ($totalProducts ?? 0)) ?></p>
    </div>
</div>

<div class="content-grid">
    <div class="box">
        <div class="box-title">
            <h2>Đơn hàng mới</h2>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach (($newOrders ?? []) as $o): ?>
                    <?php
                        $statusKey = (string)($o['status'] ?? 'pending');
                        if (!isset($statusMap[$statusKey])) {
                            $statusKey = 'pending';
                        }
                        $customerName = $o['customer_name'] ?? $o['name'] ?? 'Khách lẻ';
                    ?>
                    <tr>
                        <td>#OD<?= htmlspecialchars((string) ($o['id'] ?? '')) ?></td>
                        <td><?= htmlspecialchars((string)$customerName) ?></td>
                        <td><?= htmlspecialchars($formatMoney($o['total_price'] ?? 0)) ?></td>
                        <td>
                            <span class="status <?= htmlspecialchars($statusKey) ?>">
                                <?= htmlspecialchars($statusMap[$statusKey]) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($newOrders ?? [])): ?>
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">Chưa có đơn hàng.</div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box">
        <div class="box-title">
            <h2>Sản phẩm nổi bật</h2>
        </div>
        <div class="top-product-list">
            <div class="top-product-item">
                <img src="https://via.placeholder.com/65" alt="">
                <div class="top-product-info">
                    <h4>Đang cập nhật...</h4>
                    <span></span>
                </div>
            </div>
