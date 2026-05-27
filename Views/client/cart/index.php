<?php require_once 'Views/client/layouts/Header.php'; ?>

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Giỏ hàng</h1>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>
                            <img src="assets/client/img/fruite-item-1.jpg"
                                 class="img-fluid rounded-circle"
                                 style="width:80px;height:80px;object-fit:cover;">
                        </td>

                        <td>
                            <p class="mb-0 mt-4">Luffy Gear 5</p>
                        </td>

                        <td>
                            <p class="mb-0 mt-4">2.500.000đ</p>
                        </td>

                        <td>
                            <div class="input-group quantity mt-4" style="width:100px;">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                    <i class="fa fa-minus"></i>
                                </button>

                                <input type="text"
                                       class="form-control form-control-sm text-center border-0"
                                       value="1">

                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </td>

                        <td>
                            <p class="mb-0 mt-4">2.500.000đ</p>
                        </td>

                        <td>
                            <button class="btn btn-md rounded-circle bg-light border mt-4">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="assets/client/img/fruite-item-2.jpg"
                                 class="img-fluid rounded-circle"
                                 style="width:80px;height:80px;object-fit:cover;">
                        </td>

                        <td>
                            <p class="mb-0 mt-4">Naruto Uzumaki</p>
                        </td>

                        <td>
                            <p class="mb-0 mt-4">1.850.000đ</p>
                        </td>

                        <td>
                            <div class="input-group quantity mt-4" style="width:100px;">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                    <i class="fa fa-minus"></i>
                                </button>

                                <input type="text"
                                       class="form-control form-control-sm text-center border-0"
                                       value="1">

                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </td>

                        <td>
                            <p class="mb-0 mt-4">1.850.000đ</p>
                        </td>

                        <td>
                            <button class="btn btn-md rounded-circle bg-light border mt-4">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="row g-4 justify-content-end mt-4">
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">

                <div class="bg-light rounded">
                    <div class="p-4">

                        <h1 class="display-6 mb-4">
                            Tổng giỏ hàng
                        </h1>

                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0">Tạm tính:</h5>
                            <p class="mb-0">4.350.000đ</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0">Phí vận chuyển:</h5>
                            <p class="mb-0">Miễn phí</p>
                        </div>

                    </div>

                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4">Tổng cộng</h5>
                        <p class="mb-0 pe-4 fw-bold">4.350.000đ</p>
                    </div>

                    <a href="index.php?page=checkout"
                       class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">
                        Tiến hành thanh toán
                    </a>

                </div>

            </div>
        </div>

    </div>
</div>

<?php require_once 'Views/client/layouts/Footer.php'; ?>