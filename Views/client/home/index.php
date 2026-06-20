<?php
?>

        <!-- Hero Start -->
        <div class="container-fluid anime-hero py-5 mb-5">
            <div class="container">
                <div class="row g-5 align-items-center">

                    <div class="col-lg-7">
                        <span class="anime-hero-badge">Bộ sưu tập mới</span>

                        <h1 class="display-4 text-primary mb-4">
                            Phantom chính hãng cho người sưu tầm
                        </h1>

                        <p class="anime-hero-text">
                            Săn các mẫu Luffy, Goku, Naruto, Gojo và nhiều nhân vật nổi bật với hộp đẹp,
                            ảnh thật và giao hàng toàn quốc.
                        </p>

                        <div class="anime-hero-actions">
                            <a href="index.php?page=product" class="btn btn-primary rounded-pill text-white px-4 py-3">
                                Xem sản phẩm
                            </a>

                            <a href="index.php?page=product-detail&id=1" class="btn border border-secondary rounded-pill text-primary px-4 py-3">
                                Mẫu nổi bật
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="anime-hero-showcase">
                            <img src="assets/client/img/luffy-gear-5.jpg" alt="Figure Luffy Gear 5">

                            <div class="anime-hero-price">
                                <span>Hot deal</span>
                                <strong>2.500.000đ</strong>
                            </div>
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
                                $products = $products ?? [];
                                $fallbackImage = 'uploads/products/1781846482_gojo.webp';

                                if (!empty($products)):
                                    foreach ($products as $product):
                                        $id = $product['id'] ?? 0;
                                        $name = $product['name'] ?? $product['title'] ?? '';
                                        $image = $fallbackImage;
                                        if (!empty($product['image'])) {
                                            $image = $product['image'];
                                            if (!str_contains($image, 'uploads/')) {
                                                $image = 'uploads/products/' . $image;
                                            }
                                        }

                                        $price = 0;
                                        $oldPrice = 0;
                                        if (!empty($product['sale_price']) && $product['sale_price'] > 0) {
                                            $price = $product['sale_price'];
                                            $oldPrice = $product['price'] ?? 0;
                                        } elseif (!empty($product['price'])) {
                                            $price = $product['price'];
                                        }

                                        $category = $product['category'] ?? $product['category_name'] ?? 'Mô hình';
                                ?>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">

                                            <div class="fruite-img">
                                                <img
                                                    src="<?= htmlspecialchars($image) ?>"
                                                    class="img-fluid w-100 rounded-top"
                                                    alt="<?= htmlspecialchars($name) ?>">
                                            </div>

                                            <div
                                                class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">
                                                <?= htmlspecialchars($category) ?>
                                            </div>

                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?= htmlspecialchars($name) ?></h4>

                                                <p>
                                                    Mô hình anime chính hãng, thiết kế sắc nét, phù hợp sưu tầm.
                                                </p>

                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">
                                                        <?= number_format($price, 0, ',', '.') ?>đ
                                                    </p>

                                                    <button type="button"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary add-cart-btn"
                                                            data-id="<?= htmlspecialchars($id) ?>">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i>
                                                        Mua ngay
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php
                                    endforeach;
                                else:
                                ?>
                                    <div class="col-12 text-center py-5">
                                        <i class="fa fa-search fa-3x text-muted mb-3"></i>
                                        <p>Không có sản phẩm nổi bật để hiển thị.</p>
                                    </div>
                                <?php endif; ?>

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
                        ['img' => 'luffy-gear-5.jpg', 'name' => 'Luffy Wano Figure', 'price' => '1.990.000đ'],
                        ['img' => 'fruite-item-2.jpg', 'name' => 'Naruto Sage Mode', 'price' => '2.150.000đ'],
                        ['img' => 'fruite-item-5.webp', 'name' => 'Gojo Satoru Figure', 'price' => '2.800.000đ'],
                        ['img' => 'fruite-item-3.webp', 'name' => 'Goku Ultra Instinct', 'price' => '2.600.000đ'],
                        ['img' => 'fruite-item-6.webp', 'name' => 'Levi Ackerman', 'price' => '2.350.000đ'],
                        ['img' => 'fruite-item-4.webp', 'name' => 'Tanjiro Kamado', 'price' => '1.750.000đ'],
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-cart-btn').forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            var id = this.dataset.id;
            if (!id) return;

            fetch('index.php?page=cart&action=add&id=' + encodeURIComponent(id))
                .then(function (res) {
                    return res.json();
                })
                .then(function (data) {
                    if (data && data.login_required) {
                        window.location.href = 'index.php?page=login';
                        return;
                    }

                    if (data.success) {
                        var cartCountEl = document.querySelector('#cart-count');
                        if (cartCountEl) {
                            cartCountEl.innerText = typeof data.count !== 'undefined' ? data.count : (parseInt(cartCountEl.innerText || '0') + 1);
                        }
                    }
                })
                .catch(function () {
                    console.error('Add to cart failed.');
                });
        });
    });
});
</script>

<?php
require_once 'Views/client/layouts/Footer.php';
?>
