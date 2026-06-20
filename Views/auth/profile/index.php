<?php require_once 'Views/client/layouts/header.php'; ?>

<?php
$user = $user ?? ($_SESSION['user'] ?? []);
$orders = $orders ?? [];
$totalOrders = $totalOrders ?? count($orders);

$name = $user['name'] ?? 'Khách hàng';
$email = $user['email'] ?? 'Chưa cập nhật';
$phone = $user['phone'] ?? 'Chưa cập nhật';
$userId = $user['id'] ?? '';

$statusText = [
    'pending' => 'Chờ xác nhận',
    'confirmed' => 'Đã xác nhận',
    'shipping' => 'Đang giao',
    'delivered' => 'Đã giao',
    'completed' => 'Hoàn thành',
    'cancelled' => 'Đã hủy',
];

$statusClass = [
    'pending' => 'bg-warning text-dark',
    'confirmed' => 'bg-primary',
    'shipping' => 'bg-info text-dark',
    'delivered' => 'bg-success',
    'completed' => 'bg-success',
    'cancelled' => 'bg-danger',
];

$formatMoney = static function ($amount): string {
    return number_format((float) $amount, 0, ',', '.') . 'đ';
};

$formatDate = static function ($date): string {
    $timestamp = $date ? strtotime((string) $date) : false;
    return $timestamp ? date('d/m/Y H:i', $timestamp) : (string) ($date ?: '--');
};
?>

<style>
    .order-detail-popup {
        background: rgba(0, 0, 0, .45);
        display: none;
        inset: 0;
        overflow-y: auto;
        padding: 24px 12px;
        position: fixed;
        z-index: 1050;
    }

    .order-detail-popup.is-open {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .order-detail-popup .modal-dialog {
        margin: auto;
        max-height: calc(100vh - 48px);
        width: min(900px, 100%);
    }

    .order-detail-popup .modal-content {
        max-height: calc(100vh - 48px);
    }

    .order-detail-popup .modal-body {
        overflow-y: auto;
    }
</style>

<main class="profile-page" style="padding-top: 170px; padding-bottom: 60px;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center p-4">
                        <img src="assets/client/img/avatar.jpg"
                             alt="Avatar"
                             class="rounded-circle mb-3"
                             width="120"
                             height="120"
                             style="object-fit: cover;">

                        <h4 class="mb-1"><?= htmlspecialchars($name) ?></h4>
                        <p class="text-muted mb-2"><?= htmlspecialchars($email) ?></p>

                        <p class="mb-0">
                            <i class="fa fa-phone text-primary me-2"></i>
                            <?= htmlspecialchars($phone) ?>
                        </p>

                        <hr>

                        <a href="index.php?page=logout" class="btn btn-danger w-100">
                            Đăng xuất
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Thông tin tài khoản</h4>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded-3">
                                    <small class="text-muted">Mã tài khoản</small>
                                    <h6 class="mb-0">#<?= htmlspecialchars($userId) ?></h6>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded-3">
                                    <small class="text-muted">Họ tên</small>
                                    <h6 class="mb-0"><?= htmlspecialchars($name) ?></h6>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded-3">
                                    <small class="text-muted">Email</small>
                                    <h6 class="mb-0"><?= htmlspecialchars($email) ?></h6>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded-3">
                                    <small class="text-muted">Số điện thoại</small>
                                    <h6 class="mb-0"><?= htmlspecialchars($phone) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">Đơn hàng của tôi</h4>

                            <span class="badge bg-primary">
                                <?= htmlspecialchars((string) $totalOrders) ?> đơn
                            </span>
                        </div>

                        <?php if (empty($orders)): ?>
                            <div class="text-center py-4">
                                <p class="text-muted mb-3">Bạn chưa có đơn hàng nào.</p>

                                <a href="index.php?page=product" class="btn btn-primary">
                                    Mua sắm ngay
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="order-list">
                                <?php foreach ($orders as $order): ?>
                                    <?php
                                        $orderId = (string) ($order['id'] ?? '');
                                        $orderStatus = (string) ($order['status'] ?? 'pending');
                                        $orderStatusLabel = $statusText[$orderStatus] ?? $orderStatus;
                                        $orderStatusClass = $statusClass[$orderStatus] ?? 'bg-secondary';
                                        $orderTotal = $order['total_price'] ?? $order['total'] ?? 0;
                                        $orderName = trim((string) ($order['name'] ?? ''));

                                        if ($orderName === '') {
                                            $firstItem = $order['items'][0]['product_name'] ?? '';
                                            $orderName = $firstItem ? 'Đơn hàng ' . $firstItem : 'Đơn hàng #' . $orderId;
                                        }

                                        $modalId = 'orderDetailModal' . preg_replace('/[^A-Za-z0-9_-]/', '', $orderId);
                                    ?>

                                    <div class="card border-0 rounded-3 mb-3" style="background-color: #f9f9f9;">
                                        <div class="card-header border-0 rounded-top-3 p-3" style="background-color: #f0f0f0;">
                                            <div class="row align-items-center g-3">
                                                <div class="col-md-3">
                                                    <small class="text-muted">Mã đơn</small>
                                                    <h6 class="mb-0">#<?= htmlspecialchars($orderId) ?></h6>
                                                </div>

                                                <div class="col-md-3">
                                                    <small class="text-muted">Tổng tiền</small>
                                                    <h6 class="mb-0" style="color: #d63031;">
                                                        <?= htmlspecialchars($formatMoney($orderTotal)) ?>
                                                    </h6>
                                                </div>

                                                <div class="col-md-3">
                                                    <small class="text-muted">Trạng thái</small>
                                                    <h6 class="mb-0">
                                                        <span class="badge <?= htmlspecialchars($orderStatusClass) ?>">
                                                            <?= htmlspecialchars($orderStatusLabel) ?>
                                                        </span>
                                                    </h6>
                                                </div>

                                                <div class="col-md-3">
                                                    <small class="text-muted">Ngày tạo</small>
                                                    <div class="d-flex align-items-center justify-content-between gap-2">
                                                        <h6 class="mb-0"><?= htmlspecialchars($formatDate($order['created_at'] ?? '')) ?></h6>
                                                        <button
                                                            type="button"
                                                            class="btn btn-sm btn-primary"
                                                            data-order-modal-target="<?= htmlspecialchars($modalId) ?>">
                                                            Chi tiết
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="modal order-detail-popup"
                                            id="<?= htmlspecialchars($modalId) ?>"
                                            tabindex="-1"
                                            aria-labelledby="<?= htmlspecialchars($modalId) ?>Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div>
                                                            <h5 class="modal-title" id="<?= htmlspecialchars($modalId) ?>Label">
                                                                Chi tiết đơn hàng
                                                            </h5>
                                                            <small class="text-muted"><?= htmlspecialchars($orderName) ?></small>
                                                        </div>
                                                        <button type="button" class="btn-close" data-order-modal-close aria-label="Đóng"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row g-3 mb-4">
                                                            <div class="col-md-4">
                                                                <div class="bg-light p-3 rounded-3 h-100">
                                                                    <small class="text-muted">Tên đơn hàng</small>
                                                                    <h6 class="mb-0"><?= htmlspecialchars($orderName) ?></h6>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="bg-light p-3 rounded-3 h-100">
                                                                    <small class="text-muted">Mã đơn hàng</small>
                                                                    <h6 class="mb-0">#<?= htmlspecialchars($orderId) ?></h6>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="bg-light p-3 rounded-3 h-100">
                                                                    <small class="text-muted">Trạng thái</small>
                                                                    <h6 class="mb-0">
                                                                        <span class="badge <?= htmlspecialchars($orderStatusClass) ?>">
                                                                            <?= htmlspecialchars($orderStatusLabel) ?>
                                                                        </span>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <h6 class="mb-3">
                                                            <i class="fa fa-shopping-bag me-2"></i>Sản phẩm trong đơn
                                                        </h6>

                                                        <?php if (!empty($order['items'])): ?>
                                                            <div class="table-responsive">
                                                                <table class="table table-sm align-middle mb-0">
                                                                    <thead style="background-color: #f0f0f0;">
                                                                        <tr>
                                                                            <th style="width: 34%;">Tên đơn hàng</th>
                                                                            <th style="width: 18%;">Mã đơn hàng</th>
                                                                            <th style="width: 20%;">Tên biến thể</th>
                                                                            <th style="width: 10%;">Số lượng</th>
                                                                            <th style="width: 9%;">Giá</th>
                                                                            <th style="width: 9%;">Tổng</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($order['items'] as $item): ?>
                                                                            <?php
                                                                                $productName = (string) ($item['product_name'] ?? 'Sản phẩm không tồn tại');
                                                                                $variantName = (string) ($item['variant_name'] ?? '');
                                                                            ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong><?= htmlspecialchars($productName) ?></strong>
                                                                                    <?php if (!empty($item['sku'])): ?>
                                                                                        <br>
                                                                                        <small class="text-muted">
                                                                                            SKU: <?= htmlspecialchars((string) $item['sku']) ?>
                                                                                        </small>
                                                                                    <?php endif; ?>
                                                                                </td>
                                                                                <td>#<?= htmlspecialchars($orderId) ?></td>
                                                                                <td>
                                                                                    <?php if ($variantName !== ''): ?>
                                                                                        <span class="badge bg-light text-dark" style="border: 1px solid #ddd;">
                                                                                            <?= htmlspecialchars($variantName) ?>
                                                                                        </span>
                                                                                    <?php else: ?>
                                                                                        <span class="text-muted">Không có biến thể</span>
                                                                                    <?php endif; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <strong><?= htmlspecialchars((string) ($item['qty'] ?? 0)) ?></strong>
                                                                                </td>
                                                                                <td><?= htmlspecialchars($formatMoney($item['price'] ?? 0)) ?></td>
                                                                                <td>
                                                                                    <strong style="color: #d63031;">
                                                                                        <?= htmlspecialchars($formatMoney($item['total_price'] ?? 0)) ?>
                                                                                    </strong>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        <?php else: ?>
                                                            <p class="text-muted text-center py-3">
                                                                Không có sản phẩm trong đơn hàng này.
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <strong class="me-auto" style="color: #d63031;">
                                                            Tổng tiền: <?= htmlspecialchars($formatMoney($orderTotal)) ?>
                                                        </strong>
                                                        <button type="button" class="btn btn-secondary" data-order-modal-close>
                                                            Đóng
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('click', function (event) {
        const openButton = event.target.closest('[data-order-modal-target]');
        if (openButton) {
            const modal = document.getElementById(openButton.dataset.orderModalTarget);
            if (modal) {
                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }
            return;
        }

        const closeButton = event.target.closest('[data-order-modal-close]');
        const openModal = event.target.closest('.order-detail-popup.is-open');
        if (closeButton || (openModal && event.target === openModal)) {
            const modal = closeButton ? closeButton.closest('.order-detail-popup') : openModal;
            if (modal) {
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') {
            return;
        }

        const modal = document.querySelector('.order-detail-popup.is-open');
        if (modal) {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    });
</script>

<?php require_once 'Views/client/layouts/Footer.php'; ?>
