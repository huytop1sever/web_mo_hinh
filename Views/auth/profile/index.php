<?php require_once 'Views/client/layouts/header.php'; ?>

<?php
$user = $user ?? ($_SESSION['user'] ?? []);
$orders = $orders ?? [];
$totalOrders = $totalOrders ?? count($orders);

$name = $user['name'] ?? 'Khách hàng';
$email = $user['email'] ?? 'Chưa cập nhật';
$phone = $user['phone'] ?? 'Chưa cập nhật';
$userId = $user['id'] ?? '';
?>

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

                        <h4 class="mb-1">
                            <?= htmlspecialchars($name) ?>
                        </h4>

                        <p class="text-muted mb-2">
                            <?= htmlspecialchars($email) ?>
                        </p>

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
                                    <h6 class="mb-0">
                                        #<?= htmlspecialchars($userId) ?>
                                    </h6>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded-3">
                                    <small class="text-muted">Họ tên</small>
                                    <h6 class="mb-0">
                                        <?= htmlspecialchars($name) ?>
                                    </h6>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded-3">
                                    <small class="text-muted">Email</small>
                                    <h6 class="mb-0">
                                        <?= htmlspecialchars($email) ?>
                                    </h6>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded-3">
                                    <small class="text-muted">Số điện thoại</small>
                                    <h6 class="mb-0">
                                        <?= htmlspecialchars($phone) ?>
                                    </h6>
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
                                <?= htmlspecialchars($totalOrders) ?> đơn
                            </span>
                        </div>

                        <?php if (empty($orders)): ?>

                            <div class="text-center py-4">
                                <p class="text-muted mb-3">
                                    Bạn chưa có đơn hàng nào.
                                </p>

                                <a href="index.php?page=product" class="btn btn-primary">
                                    Mua sắm ngay
                                </a>
                            </div>

                        <?php else: ?>

                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($orders as $order): ?>
                                            <tr>
                                                <td>
                                                    #<?= htmlspecialchars($order['id'] ?? '') ?>
                                                </td>

                                                <td>
                                                    <?= number_format($order['total_price'] ?? $order['total'] ?? 0, 0, ',', '.') ?>đ
                                                </td>

                                                <td>
                                                    <?= htmlspecialchars($order['status'] ?? 'Đang xử lý') ?>
                                                </td>

                                                <td>
                                                    <?= htmlspecialchars($order['created_at'] ?? '') ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        <?php endif; ?>

                    </div>
                </div>

            </div>

        </div>

    </div>
</main>

<?php require_once 'Views/client/layouts/Footer.php'; ?>