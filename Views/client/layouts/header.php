<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>ASM Figure Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Bootstrap -->
    <link href="assets/client/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Style -->
    <link href="assets/client/css/style.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid fixed-top">

    <!-- Topbar -->
    <div class="container topbar bg-primary d-none d-lg-block">

        <div class="d-flex justify-content-between">

            <div class="top-info ps-2">

                <small class="me-3 text-white">
                    <i class="fas fa-phone-alt me-2 text-warning"></i>
                    Hotline: 0909 999 999
                </small>

                <small class="text-white">
                    <i class="fas fa-envelope me-2 text-warning"></i>
                    support@asmfigure.com
                </small>

            </div>

            <div class="top-link pe-2">

                <small class="text-white">
                    Miễn phí vận chuyển cho đơn hàng từ 500.000đ
                </small>

            </div>

        </div>

    </div>

    <!-- Navbar -->
    <div class="container px-0">

        <nav class="navbar navbar-light bg-white navbar-expand-xl">

            <a href="index.php" class="navbar-brand">
                <h1 class="text-primary display-6 mb-0">
                    ASM Figure
                </h1>
            </a>

            <button
                class="navbar-toggler py-2 px-3"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">

                <span class="fa fa-bars text-primary"></span>

            </button>

            <div class="collapse navbar-collapse bg-white"
                id="navbarCollapse">

                <div class="navbar-nav mx-auto">

                    <a href="index.php"
                        class="nav-item nav-link active">
                        Trang chủ
                    </a>

                    <a href="#"
                        class="nav-item nav-link">
                        Sản phẩm
                    </a>

                    <a href="#"
                        class="nav-item nav-link">
                        Danh mục
                    </a>

                    <a href="#"
                        class="nav-item nav-link">
                        Tin tức
                    </a>

                    <a href="#"
                        class="nav-item nav-link">
                        Liên hệ
                    </a>

            

                </div>

                <div class="d-flex m-3 me-0">

                    <button
                        class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal"
                        data-bs-target="#searchModal">

                        <i class="fas fa-search text-primary"></i>

                    </button>

                    <a href="#"
                        class="position-relative me-4 my-auto">

                        <i class="fa fa-heart fa-2x text-primary"></i>

                    </a>

                    <a href="index.php?page=cart"
                        class="position-relative me-4 my-auto">

                        <i class="fa fa-shopping-bag fa-2x text-primary"></i>

                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top:-5px;left:15px;height:20px;min-width:20px;">
                            0
                        </span>

                    </a>

                    <a href="index.php?page=login"
                        class="my-auto">

                        <i class="fas fa-user fa-2x text-primary"></i>

                    </a>

                </div>

            </div>

        </nav>

    </div>

</div>

<!-- Search Modal -->
<div class="modal fade"
    id="searchModal"
    tabindex="-1">

    <div class="modal-dialog modal-fullscreen">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Tìm kiếm sản phẩm
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body d-flex align-items-center">

                <div class="input-group w-75 mx-auto">

                    <input
                        type="search"
                        class="form-control p-3"
                        placeholder="Nhập tên mô hình...">

                    <button class="btn btn-primary px-4">

                        <i class="fa fa-search"></i>

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>
