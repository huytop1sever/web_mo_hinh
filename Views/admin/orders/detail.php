<?php
$order = [
    'id' => '#OD001',
    'customer' => 'Nguyễn Văn A',
    'email' => 'admin@gmail.com',
    'phone' => '0987654321',
    'address' => '123 Nguyễn Văn Cừ, Quận 5, TP.HCM',
    'products' => [
        [
            'name' => 'Mô hình Luffy Gear 5',
            'quantity' => 1,
        ],
        [
            'name' => 'Mô hình Gojo Satoru',
            'quantity' => 2,
        ],
        [
            'name' => 'Mô hình Naruto',
            'quantity' => 1,
        ],
    ],
    'total' => '6.200.000đ',
    'payment_method' => 'COD',
    'status' => 'Đang giao',
    'note' => 'Không có ghi chú',
];
?>

<div class="orders-page">

    <div class="box">

        <div class="box-title">
            <h2>Chi tiết đơn hàng</h2>

            <a href="index.php?page=orders" class="btn-primary">
                <i class='bx bx-arrow-back'></i>
                Quay lại
            </a>
        </div>

        <div class="order-detail">

            <div class="detail-group">
                <span>Mã đơn:</span>
                <strong><?= $order['id'] ?></strong>
            </div>

            <div class="detail-group">
                <span>Khách hàng:</span>
                <strong><?= $order['customer'] ?></strong>
            </div>

            <div class="detail-group">
                <span>Email:</span>
                <strong><?= $order['email'] ?></strong>
            </div>

            <div class="detail-group">
                <span>Số điện thoại:</span>
                <strong><?= $order['phone'] ?></strong>
            </div>

            <div class="detail-group full">
                <span>Địa chỉ nhận hàng:</span>
                <strong><?= $order['address'] ?></strong>
            </div>

            <div class="detail-group full">
                <span>Sản phẩm trong đơn:</span>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($order['products'] as $product): ?>
                                <tr>
                                    <td><?= $product['name'] ?></td>
                                    <td><?= $product['quantity'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="detail-group">
                <span>Tổng tiền:</span>
                <strong><?= $order['total'] ?></strong>
            </div>

            <div class="detail-group">
                <span>Thanh toán:</span>
                <strong class="payment-method"><?= $order['payment_method'] ?></strong>
            </div>

            <div class="detail-group">
                <span>Trạng thái hiện tại:</span>
                <strong id="currentOrderStatus" class="current-status">
                    <?= $order['status'] ?>
                </strong>
            </div>

            <div class="detail-group full">
                <span>Xử lý trạng thái:</span>

                <div class="order-status-actions">

                    <button type="button"
                        class="status-btn pending"
                        onclick="changeOrderStatus(this, 'Chờ xác nhận')">
                        <i class='bx bx-time'></i>
                        Chờ xác nhận
                    </button>

                    <button type="button"
                        class="status-btn confirmed"
                        onclick="changeOrderStatus(this, 'Đã xác nhận')">
                        <i class='bx bx-check-circle'></i>
                        Đã xác nhận
                    </button>

                    <button type="button"
                        class="status-btn shipping active"
                        onclick="changeOrderStatus(this, 'Đang giao')">
                        <i class='bx bx-package'></i>
                        Đang giao
                    </button>

                    <button type="button"
                        class="status-btn delivered"
                        onclick="changeOrderStatus(this, 'Đã giao')">
                        <i class='bx bx-check-double'></i>
                        Đã giao
                    </button>

                    <button type="button"
                        class="status-btn cancelled"
                        onclick="changeOrderStatus(this, 'Đã hủy')">
                        <i class='bx bx-x-circle'></i>
                        Đã hủy
                    </button>

                </div>
            </div>

            <div class="detail-group full">
                <span>Ghi chú:</span>
                <textarea readonly><?= $order['note'] ?></textarea>
            </div>

        </div>

    </div>

</div>

<script>
    function changeOrderStatus(button, status) {
        document.getElementById('currentOrderStatus').innerText = status;

        const buttons = document.querySelectorAll('.status-btn');

        buttons.forEach(function(item) {
            item.classList.remove('active');
        });

        button.classList.add('active');
    }
</script>