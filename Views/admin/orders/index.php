<?php $orders = $orders ?? []; ?>

<?php if (isset($_GET['msg'])): ?>
<div id="toast" class="toast-message">
    <?php
    switch ($_GET['msg']) {
        case 'deleted':
            echo "🗑️ Xóa đơn hàng thành công";
            break;
        case 'error':
            echo "❌ Có lỗi xảy ra";
            break;
    }
    ?>
</div>
<?php endif; ?>

<div class="orders-page">

    <div class="box">

        <div class="box-title">
            <h2>Danh sách đơn hàng</h2>
        </div>

        <div class="table-wrapper">

            <table>
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
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#OD<?= $order['id'] ?></td>

                            <td><?= htmlspecialchars($order['name'] ?? $order['customer_name'] ?? '') ?></td>

                            <td><?= number_format($order['total_price'] ?? $order['total'] ?? 0) ?>đ</td>

                            <td>
                                <?php if (($order['payment_status'] ?? 0) == 1): ?>
                                    <span class="payment paid">Đã thanh toán</span>
                                <?php else: ?>
                                    <span class="payment unpaid">Chưa thanh toán</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php
                                    $status = $order['status'] ?? 'pending';

                                    $statusText = [
                                        'pending'   => 'Chờ xác nhận',
                                        'confirmed' => 'Đã xác nhận',
                                        'shipping'  => 'Đang giao',
                                        'delivered' => 'Hoàn thành',
                                        'cancelled' => 'Đã hủy'
                                    ];
                                    ?>

                                    <span class="status <?= $status ?>">
                                        <?= $statusText[$status] ?? 'Không xác định' ?>
                                    </span>
                            </td>

                            <td><?= htmlspecialchars($order['created_at'] ?? '') ?></td>

                            <td>
                                <div class="table-actions">

                                    <a 
                                        class="action-btn view"
                                        href="index.php?page=order-detail&id=<?= $order['id'] ?>"
                                    >
                                        <i class='bx bx-show'></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="7" style="text-align:center;">
                                Chưa có đơn hàng
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>

    </div>

</div>

<div class="modal" id="confirmModal">

    <div class="confirm-modal">

        <i class='bx bx-trash'></i>

        <h3>Xóa đơn hàng?</h3>

        <p>Đơn hàng sẽ bị xóa khỏi hệ thống.</p>

        <div class="confirm-actions">
            <button type="button" class="btn-cancel" onclick="closeConfirmModal()">
                Hủy
            </button>

            <a href="#" id="confirmBtn" class="btn-danger">
                Xóa đơn hàng
            </a>
        </div>

    </div>

</div>

<script src="../assets/admin/js/orders.js"></script>