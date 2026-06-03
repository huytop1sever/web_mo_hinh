<?php
$orders = [
    [
        'id' => '#OD001',
        'customer' => 'Nguyễn Văn A',
        'product' => 'Mô hình Luffy Gear 5',
        'total' => '2.500.000đ',
        'payment' => 'Đã thanh toán',
        'payment_class' => 'paid',
        'status' => 'Đang giao',
        'status_class' => 'confirmed',
    ],
    [
        'id' => '#OD002',
        'customer' => 'Trần Văn B',
        'product' => 'Mô hình Gojo Satoru',
        'total' => '1.850.000đ',
        'payment' => 'Chưa thanh toán',
        'payment_class' => 'unpaid',
        'status' => 'Chờ xác nhận',
        'status_class' => 'pending',
    ],
    [
        'id' => '#OD003',
        'customer' => 'Lê Văn C',
        'product' => 'Mô hình Naruto',
        'total' => '990.000đ',
        'payment' => 'Đã thanh toán',
        'payment_class' => 'paid',
        'status' => 'Hoàn thành',
        'status_class' => 'delivered',
    ],
];
?>

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
                        <th>Sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order['id'] ?></td>
                            <td><?= $order['customer'] ?></td>
                            <td><?= $order['product'] ?></td>
                            <td><?= $order['total'] ?></td>

                            <td>
                                <span class="payment <?= $order['payment_class'] ?>">
                                    <?= $order['payment'] ?>
                                </span>
                            </td>

                            <td>
                                <span class="status <?= $order['status_class'] ?>">
                                    <?= $order['status'] ?>
                                </span>
                            </td>

                            <td>
                                <div class="table-actions">

                                    <a href="index.php?page=order-detail&id=<?= $order['id'] ?>"
                                        class="action-btn view">
                                        <i class='bx bx-show'></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>

</div>