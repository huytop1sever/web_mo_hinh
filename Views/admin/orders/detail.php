<?php
$order = $order ?? [];
$orderDetails = $orderDetails ?? [];

$paymentStatus = $order['payment_status'] ?? 'unpaid';

$statusText = [
    'pending' => 'Chờ xác nhận',
    'confirmed' => 'Đã xác nhận',
    'shipping' => 'Đang giao',
    'delivered' => 'Hoàn thành',
    'cancelled' => 'Đã hủy'
];
?>

<?php if (isset($_GET['msg'])): ?>
<div id="toast" class="toast-message">
    <?php
    switch ($_GET['msg']) {
        case 'updated':
            echo "✅ Cập nhật trạng thái thành công";
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
            <h2>Chi tiết đơn hàng #OD<?= $order['id'] ?? '' ?></h2>

            <a href="index.php?page=orders" class="btn-primary">
                <i class='bx bx-arrow-back'></i>
                Quay lại
            </a>
        </div>

        <form action="index.php?page=order-update-status" method="POST" class="order-detail">

            <input type="hidden" name="id" value="<?= $order['id'] ?? '' ?>">

            <div class="detail-group">
                <span>Mã đơn:</span>
                <strong>#OD<?= $order['id'] ?? '' ?></strong>
            </div>

            <div class="detail-group">
                <span>Khách hàng:</span>
                <strong><?= htmlspecialchars($order['name'] ?? '') ?></strong>
            </div>

            <div class="detail-group">
                <span>Số điện thoại:</span>
                <strong><?= htmlspecialchars($order['phone'] ?? '') ?></strong>
            </div>

            <div class="detail-group">
                <span>Ngày đặt:</span>
                <strong><?= htmlspecialchars($order['created_at'] ?? '') ?></strong>
            </div>

            <div class="detail-group full">
                <span>Địa chỉ nhận hàng:</span>
                <strong><?= htmlspecialchars($order['address'] ?? '') ?></strong>
            </div>

            <div class="detail-group">
                <span>Phương thức:</span>
                <strong><?= htmlspecialchars($order['payment_method'] ?? 'COD') ?></strong>
            </div>

            <div class="detail-group">
                <span>Thanh toán:</span>
                <strong>
                    <?= ($paymentStatus === 'paid') ? 'Đã thanh toán' : 'Chưa thanh toán' ?>
                </strong>
            </div>

            <div class="detail-group">
                <span>Tổng tiền:</span>
                <strong><?= number_format($order['total_price'] ?? 0) ?>đ</strong>
            </div>

            <div class="detail-group">
                <span>Trạng thái:</span>

                <select name="status">
                    <?php foreach ($statusText as $key => $text): ?>
                        <option value="<?= $key ?>" <?= (($order['status'] ?? '') === $key) ? 'selected' : '' ?>>
                            <?= $text ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="detail-group full">
                <span>Sản phẩm trong đơn:</span>

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
                            <tr>
                                <td><?= htmlspecialchars($item['product_name'] ?? $item['name'] ?? '') ?></td>
                                <td><?= $item['qty'] ?? 1 ?></td>
                                <td><?= number_format($item['price'] ?? 0) ?>đ</td>
                                <td><?= number_format($item['total_price'] ?? 0) ?>đ</td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($orderDetails)): ?>
                            <tr>
                                <td colspan="4" style="text-align:center;">
                                    Chưa có sản phẩm trong đơn hàng
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <strong>Tổng cộng</strong>
                            </td>
                            <td>
                                <strong><?= number_format($order['total_price'] ?? 0) ?>đ</strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="detail-group full">
                <span>Ghi chú:</span>
                <textarea readonly><?= htmlspecialchars($order['note'] ?? '') ?></textarea>
            </div>

            <div class="form-actions full">
                <button type="submit" class="btn-save">
                    Cập nhật trạng thái
                </button>
            </div>

        </form>

    </div>

</div>

<script src="../assets/admin/js/orders.js"></script>