<?php

$title = 'Dashboard';
$pageTitle = 'Dashboard';

include_once __DIR__ . '/../layouts/header.php';
include_once __DIR__ . '/../layouts/sidebar.php';
include_once __DIR__ . '/../layouts/navbar.php';

?>

<div class="dashboard-grid">

    <div class="dashboard-card">

        <div class="card-top">
            <h3>Tổng doanh thu</h3>

            <i class='bx bx-dollar-circle'></i>
        </div>

        <p>850.000.000đ</p>

    </div>

    <div class="dashboard-card">

        <div class="card-top">
            <h3>Đơn hàng</h3>

            <i class='bx bx-cart'></i>
        </div>

        <p>1.250</p>

    </div>

    <div class="dashboard-card">

        <div class="card-top">
            <h3>Người dùng</h3>

            <i class='bx bx-user'></i>
        </div>

        <p>5.680</p>

    </div>

    <div class="dashboard-card">

        <div class="card-top">
            <h3>Sản phẩm</h3>

            <i class='bx bx-package'></i>
        </div>

        <p>325</p>

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

                    <tr>
                        <td>#DH001</td>
                        <td>Nguyễn Văn A</td>
                        <td>2.500.000đ</td>

                        <td>
                            <span class="status pending">
                                Đang xử lý
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>#DH002</td>
                        <td>Trần Văn B</td>
                        <td>5.200.000đ</td>

                        <td>
                            <span class="status confirmed">
                                Đã xác nhận
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>#DH003</td>
                        <td>Lê Văn C</td>
                        <td>1.250.000đ</td>

                        <td>
                            <span class="status delivered">
                                Đã giao
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>#DH004</td>
                        <td>Phạm Văn D</td>
                        <td>850.000đ</td>

                        <td>
                            <span class="status cancelled">
                                Đã hủy
                            </span>
                        </td>
                    </tr>

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
                    <h4>Ghế Gaming RGB</h4>
                    <span>245 đơn bán</span>
                </div>

            </div>

            <div class="top-product-item">

                <img src="https://via.placeholder.com/65" alt="">

                <div class="top-product-info">
                    <h4>Bàn Gaming Pro</h4>
                    <span>190 đơn bán</span>
                </div>

            </div>

            <div class="top-product-item">

                <img src="https://via.placeholder.com/65" alt="">

                <div class="top-product-info">
                    <h4>Tai nghe Bluetooth</h4>
                    <span>170 đơn bán</span>
                </div>

            </div>

            <div class="top-product-item">

                <img src="https://via.placeholder.com/65" alt="">

                <div class="top-product-info">
                    <h4>Chuột Gaming</h4>
                    <span>120 đơn bán</span>
                </div>

            </div>

        </div>

    </div>

</div>

<?php

include_once __DIR__ . '/../layouts/footer.php';

?>