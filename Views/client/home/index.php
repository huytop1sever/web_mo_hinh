<?php
require_once 'Views/client/layouts/Header.php';
?>
        <!-- Hero Start -->
        <div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">

                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">Mô hình Anime chính hãng</h4>

                        <h1 class="mb-5 display-3 text-primary">
                            Bộ sưu tập Figure cao cấp
                        </h1>

                        <div class="position-relative mx-auto">
                            <input
                                class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill"
                                type="text"
                                placeholder="Tìm kiếm mô hình...">

                            <button
                                type="submit"
                                class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                                style="top: 0; right: 25%;">
                                Tìm kiếm
                            </button>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">

                            <div class="carousel-inner" role="listbox">

                                <div class="carousel-item active rounded">
                                    <img
                                        src="assets/client/img/hero-img-1.png"
                                        class="img-fluid w-100 h-100 bg-secondary rounded"
                                        alt="Mô hình Anime">

                                    <a href="#" class="btn px-4 py-2 text-white rounded">
                                        Anime Figure
                                    </a>
                                </div>

                                <div class="carousel-item rounded">
                                    <img
                                        src="assets/client/img/hero-img-2.jpg"
                                        class="img-fluid w-100 h-100 rounded"
                                        alt="Mô hình sưu tầm">

                                    <a href="#" class="btn px-4 py-2 text-white rounded">
                                        Nendoroid
                                    </a>
                                </div>

                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Features Start -->
        <div class="container-fluid featurs py-5">
            <div class="container py-5">
                <div class="row g-4">

                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-truck fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Giao hàng toàn quốc</h5>
                                <p class="mb-0">Nhanh chóng, an toàn</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-shield-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Thanh toán an toàn</h5>
                                <p class="mb-0">Bảo mật 100%</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-exchange-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Đổi trả 7 ngày</h5>
                                <p class="mb-0">Hỗ trợ đổi sản phẩm lỗi</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fa fa-phone-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Hỗ trợ 24/7</h5>
                                <p class="mb-0">Tư vấn nhanh chóng</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Features End -->


        <!-- Product Start -->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">

                <div class="tab-class text-center">

                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Sản phẩm nổi bật</h1>
                        </div>

                        <div class="col-lg-8 text-end">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">

                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                        <span class="text-dark" style="width: 130px;">Tất cả</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                        <span class="text-dark" style="width: 130px;">One Piece</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                        <span class="text-dark" style="width: 130px;">Naruto</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                        <span class="text-dark" style="width: 130px;">Dragon Ball</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="tab-content">

                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">

                                <?php
                                $products = [
                                    ['img' => 'fruite-item-1.jpg', 'cat' => 'One Piece', 'name' => 'Luffy Gear 5', 'price' => '2.500.000đ'],
                                    ['img' => 'fruite-item-2.jpg', 'cat' => 'Naruto', 'name' => 'Naruto Uzumaki', 'price' => '1.850.000đ'],
                                    ['img' => 'fruite-item-3.jpg', 'cat' => 'Dragon Ball', 'name' => 'Son Goku', 'price' => '2.200.000đ'],
                                    ['img' => 'fruite-item-4.jpg', 'cat' => 'Demon Slayer', 'name' => 'Tanjiro Kamado', 'price' => '1.650.000đ'],
                                    ['img' => 'fruite-item-5.jpg', 'cat' => 'Jujutsu Kaisen', 'name' => 'Gojo Satoru', 'price' => '2.900.000đ'],
                                    ['img' => 'fruite-item-6.jpg', 'cat' => 'Attack On Titan', 'name' => 'Levi Ackerman', 'price' => '2.750.000đ'],
                                    ['img' => 'best-product-1.jpg', 'cat' => 'Nendoroid', 'name' => 'Nendoroid Anime', 'price' => '950.000đ'],
                                    ['img' => 'best-product-2.jpg', 'cat' => 'PVC Figure', 'name' => 'PVC Collection', 'price' => '1.200.000đ'],
                                ];

                                foreach ($products as $product) {
                                ?>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">

                                            <div class="fruite-img">
                                                <img
                                                    src="assets/client/img/<?php echo $product['img']; ?>"
                                                    class="img-fluid w-100 rounded-top"
                                                    alt="<?php echo $product['name']; ?>">
                                            </div>

                                            <div
                                                class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">
                                                <?php echo $product['cat']; ?>
                                            </div>

                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo $product['name']; ?></h4>

                                                <p>
                                                    Mô hình anime chính hãng, thiết kế sắc nét, phù hợp sưu tầm.
                                                </p>

                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">
                                                        <?php echo $product['price']; ?>
                                                    </p>

                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i>
                                                        Mua ngay
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="assets/client/img/fruite-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top:10px;left:10px;">
                                            One Piece
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>Luffy Gear 5</h4>
                                            <p>Figure One Piece chính hãng.</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">2.500.000đ</p>
                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i>Mua ngay
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-3" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="assets/client/img/fruite-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top:10px;left:10px;">
                                            Naruto
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>Naruto Uzumaki</h4>
                                            <p>Figure Naruto chi tiết cao.</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">1.850.000đ</p>
                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i>Mua ngay
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-4" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="assets/client/img/fruite-item-3.jpg" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top:10px;left:10px;">
                                            Dragon Ball
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>Son Goku</h4>
                                            <p>Figure Dragon Ball nổi bật.</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">2.200.000đ</p>
                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i>Mua ngay
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- Product End -->


        <!-- Banner Start -->
        <div class="container-fluid banner bg-secondary my-5">
            <div class="container py-5">
                <div class="row g-4 align-items-center">

                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white">
                                Khuyến mãi Figure Anime
                            </h1>

                            <p class="fw-normal display-3 text-dark mb-4">
                                Giảm giá đặc biệt
                            </p>

                            <p class="mb-4 text-dark">
                                Nhiều mẫu mô hình Anime, Manga, Nendoroid đang có ưu đãi hấp dẫn.
                            </p>

                            <a href="#" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">
                                Mua ngay
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img
                                src="assets/client/img/baner-1.png"
                                class="img-fluid w-100 rounded"
                                alt="Khuyến mãi Figure">

                            <div
                                class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute"
                                style="width:140px;height:140px;top:0;left:0;">

                                <h1 style="font-size:70px;">30</h1>

                                <div class="d-flex flex-column">
                                    <span class="h2 mb-0">%</span>
                                    <span class="h4 text-muted mb-0">OFF</span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Banner End -->


        <!-- Bestseller Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">

                <div class="text-center mx-auto mb-5" style="max-width:700px;">
                    <h1 class="display-4">Sản phẩm bán chạy</h1>
                    <p>
                        Những mẫu Figure được khách hàng yêu thích và đặt mua nhiều nhất.
                    </p>
                </div>

                <div class="row g-4">

                    <?php
                    $bestProducts = [
                        ['img' => 'best-product-1.jpg', 'name' => 'Luffy Wano Figure', 'price' => '1.990.000đ'],
                        ['img' => 'best-product-2.jpg', 'name' => 'Naruto Sage Mode', 'price' => '2.150.000đ'],
                        ['img' => 'best-product-3.jpg', 'name' => 'Gojo Satoru Figure', 'price' => '2.800.000đ'],
                        ['img' => 'best-product-4.jpg', 'name' => 'Goku Ultra Instinct', 'price' => '2.600.000đ'],
                        ['img' => 'best-product-5.jpg', 'name' => 'Levi Ackerman', 'price' => '2.350.000đ'],
                        ['img' => 'best-product-6.jpg', 'name' => 'Tanjiro Kamado', 'price' => '1.750.000đ'],
                    ];

                    foreach ($bestProducts as $item) {
                    ?>
                        <div class="col-lg-6 col-xl-4">
                            <div class="p-4 rounded bg-light">
                                <div class="row align-items-center">

                                    <div class="col-6">
                                        <img
                                            src="assets/client/img/<?php echo $item['img']; ?>"
                                            class="img-fluid rounded-circle w-100"
                                            alt="<?php echo $item['name']; ?>">
                                    </div>

                                    <div class="col-6">
                                        <a href="#" class="h5">
                                            <?php echo $item['name']; ?>
                                        </a>

                                        <div class="d-flex my-3">
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star"></i>
                                        </div>

                                        <h4 class="mb-3">
                                            <?php echo $item['price']; ?>
                                        </h4>

                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary">
                                            <i class="fa fa-shopping-bag me-2 text-primary"></i>
                                            Mua ngay
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>

            </div>
        </div>
        <!-- Bestseller End -->


        <!-- Fact Start -->
        <div class="container-fluid py-5">
            <div class="container">

                <div class="bg-light p-5 rounded">

                    <div class="row g-4 justify-content-center">

                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Khách hàng</h4>
                                <h1>5000+</h1>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-shopping-bag text-secondary"></i>
                                <h4>Đơn hàng</h4>
                                <h1>12000+</h1>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-box text-secondary"></i>
                                <h4>Sản phẩm</h4>
                                <h1>1000+</h1>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-handshake text-secondary"></i>
                                <h4>Đối tác</h4>
                                <h1>50+</h1>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- Fact End -->
<?php
require_once 'Views/client/layouts/Footer.php';
?>