<?php require_once 'Views/client/layouts/Header.php'; ?>

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Thanh toán</h1>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">

        <form action="#" method="post">

            <div class="row g-5">

                <div class="col-md-12 col-lg-6 col-xl-7">

                    <h2 class="mb-4">Thông tin nhận hàng</h2>

                    <div class="form-item mb-3">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" placeholder="Nhập họ tên">
                    </div>

                    <div class="form-item mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" placeholder="Nhập số điện thoại">
                    </div>

                    <div class="form-item mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Nhập email">
                    </div>

                    <div class="form-item mb-3">
                        <label class="form-label">Địa chỉ nhận hàng</label>
                        <input type="text" class="form-control" placeholder="Số nhà, đường, phường/xã, quận/huyện">
                    </div>

                    <div class="form-item mb-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea class="form-control"
                                  rows="5"
                                  placeholder="Ghi chú đơn hàng"></textarea>
                    </div>

                </div>

                <div class="col-md-12 col-lg-6 col-xl-5">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>SL</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>
                                        <img src="assets/client/img/fruite-item-1.jpg"
                                             class="img-fluid rounded-circle"
                                             style="width:70px;height:70px;object-fit:cover;">
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4">Luffy Gear 5</p>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4">2.500.000đ</p>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4">1</p>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4">2.500.000đ</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <img src="assets/client/img/fruite-item-2.jpg"
                                             class="img-fluid rounded-circle"
                                             style="width:70px;height:70px;object-fit:cover;">
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4">Naruto Uzumaki</p>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4">1.850.000đ</p>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4">1</p>
                                    </td>

                                    <td>
                                        <p class="mb-0 mt-4">1.850.000đ</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4">
                                        <h5 class="mt-4">Tạm tính</h5>
                                    </td>

                                    <td>
                                        <p class="mt-4">4.350.000đ</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4">
                                        <h5>Phí vận chuyển</h5>
                                    </td>

                                    <td>
                                        <p>Miễn phí</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4">
                                        <h5>Tổng cộng</h5>
                                    </td>

                                    <td>
                                        <h5>4.350.000đ</h5>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start">
                                <input type="radio"
                                       class="form-check-input"
                                       name="payment"
                                       id="cod"
                                       checked>

                                <label class="form-check-label" for="cod">
                                    Thanh toán khi nhận hàng
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start">
                                <input type="radio"
                                       class="form-check-input"
                                       name="payment"
                                       id="bank">

                                <label class="form-check-label" for="bank">
                                    Chuyển khoản ngân hàng
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="submit"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">
                            Đặt hàng
                        </button>
                    </div>

                </div>

            </div>

        </form>

    </div>
</div>

<?php require_once 'Views/client/layouts/Footer.php'; ?>