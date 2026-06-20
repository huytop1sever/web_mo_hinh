<?php
$products = $products ?? [];
$categories = $categories ?? [];
$posts = $posts ?? [];

$fallbackImage = 'uploads/products/1781846482_gojo.webp';

function productImagePath($image, $fallbackImage)
{
    if (empty($image)) return $fallbackImage;

    if (str_contains($image, 'uploads/') || str_contains($image, 'assets/') || str_contains($image, 'http')) {
        return $image;
    }

    return 'uploads/products/' . $image;
}

function postImagePath($image)
{
    if (empty($image)) return 'assets/client/img/blog-default.jpg';

    if (str_contains($image, 'uploads/') || str_contains($image, 'assets/') || str_contains($image, 'http')) {
        return $image;
    }

    return 'uploads/posts/' . $image;
}
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
                    <h5>Giao hàng toàn quốc</h5>
                    <p class="mb-0">Nhanh chóng, an toàn</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-shield-alt fa-3x text-white"></i>
                    </div>
                    <h5>Thanh toán an toàn</h5>
                    <p class="mb-0">Bảo mật 100%</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-exchange-alt fa-3x text-white"></i>
                    </div>
                    <h5>Đổi trả 7 ngày</h5>
                    <p class="mb-0">Hỗ trợ đổi sản phẩm lỗi</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <h5>Hỗ trợ 24/7</h5>
                    <p class="mb-0">Tư vấn nhanh chóng</p>
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

                    </ul>
                </div>
            </div>

            <div class="tab-content">

                <div id="tab-all" class="tab-pane fade show p-0 active">
                    <div class="row g-4">

                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <?php
                                $id = $product['id'] ?? 0;
                                $name = $product['name'] ?? $product['title'] ?? '';
                                $image = productImagePath($product['image'] ?? '', $fallbackImage);
                                $price = !empty($product['sale_price']) ? $product['sale_price'] : ($product['price'] ?? 0);
                                $categoryName = $product['category'] ?? $product['category_name'] ?? 'Mô hình';
                                ?>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">

                                        <a href="index.php?page=product-detail&id=<?= htmlspecialchars($id) ?>"
                                           class="text-decoration-none text-dark">
                                            <div class="fruite-img">
                                                <img src="<?= htmlspecialchars($image) ?>"
                                                     class="img-fluid w-100 rounded-top"
                                                     alt="<?= htmlspecialchars($name) ?>">
                                            </div>
                                        </a>

                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                             style="top:10px;left:10px;">
                                            <?= htmlspecialchars($categoryName) ?>
                                        </div>

                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <a href="index.php?page=product-detail&id=<?= htmlspecialchars($id) ?>"
                                               class="text-decoration-none text-dark">
                                                <h4><?= htmlspecialchars($name) ?></h4>
                                            </a>

                                            <p>Mô hình anime chính hãng, thiết kế sắc nét, phù hợp sưu tầm.</p>

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
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center py-5">
                                <p>Không có sản phẩm nổi bật để hiển thị.</p>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <?php foreach ($categories as $category): ?>
                    <div id="tab-category-<?= htmlspecialchars($category['id']) ?>" class="tab-pane fade p-0">
                        <div class="row g-4">

                            <?php
                            $hasProduct = false;
                            foreach ($products as $product):
                                if (($product['category_id'] ?? '') != $category['id']) continue;

                                $hasProduct = true;
                                $id = $product['id'] ?? 0;
                                $name = $product['name'] ?? $product['title'] ?? '';
                                $image = productImagePath($product['image'] ?? '', $fallbackImage);
                                $price = !empty($product['sale_price']) ? $product['sale_price'] : ($product['price'] ?? 0);
                            ?>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">

                                        <a href="index.php?page=product-detail&id=<?= htmlspecialchars($id) ?>"
                                           class="text-decoration-none text-dark">
                                            <div class="fruite-img">
                                                <img src="<?= htmlspecialchars($image) ?>"
                                                     class="img-fluid w-100 rounded-top"
                                                     alt="<?= htmlspecialchars($name) ?>">
                                            </div>
                                        </a>

                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                             style="top:10px;left:10px;">
                                            <?= htmlspecialchars($category['name']) ?>
                                        </div>

                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <a href="index.php?page=product-detail&id=<?= htmlspecialchars($id) ?>"
                                               class="text-decoration-none text-dark">
                                                <h4><?= htmlspecialchars($name) ?></h4>
                                            </a>

                                            <p>Mô hình anime chính hãng, thiết kế sắc nét, phù hợp sưu tầm.</p>

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

                            <?php endforeach; ?>

                            <?php if (!$hasProduct): ?>
                                <div class="col-12 text-center py-5">
                                    <p>Chưa có sản phẩm trong danh mục này.</p>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>
</div>
<!-- Product End -->


<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container py-5">

        <div class="text-center mx-auto mb-5" style="max-width:700px;">
            <h1 class="display-4">Bài viết mới</h1>
            <p>Cập nhật tin tức, kinh nghiệm sưu tầm và đánh giá figure mới nhất.</p>
        </div>

        <div class="row g-4">

            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <?php
                    $postId = $post['id'] ?? 0;
                    $postTitle = $post['title'] ?? '';
                    $postImage = postImagePath($post['image'] ?? '');
                    $postDescription = $post['excerpt']
                        ?? $post['description']
                        ?? mb_substr(strip_tags($post['content'] ?? ''), 0, 120) . '...';
                    ?>

                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 home-post-card">

                            <a href="index.php?page=post-detail&id=<?= htmlspecialchars($postId) ?>">
                                <img src="<?= htmlspecialchars($postImage) ?>"
                                     class="card-img-top home-post-img"
                                     alt="<?= htmlspecialchars($postTitle) ?>">
                            </a>

                            <div class="card-body p-4">
                                <h5 class="card-title">
                                    <a href="index.php?page=post-detail&id=<?= htmlspecialchars($postId) ?>"
                                       class="text-dark text-decoration-none">
                                        <?= htmlspecialchars($postTitle) ?>
                                    </a>
                                </h5>

                                <p class="text-muted mt-3">
                                    <?= htmlspecialchars($postDescription) ?>
                                </p>

                                <a href="index.php?page=post-detail&id=<?= htmlspecialchars($postId) ?>"
                                   class="btn border border-secondary rounded-pill px-3 text-primary">
                                    Xem chi tiết
                                </a>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p>Chưa có bài viết để hiển thị.</p>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>
<!-- Blog End -->


<!-- Bestseller Start -->
<div class="container-fluid py-5">
    <div class="container py-5">

        <div class="text-center mx-auto mb-5" style="max-width:700px;">
            <h1 class="display-4">Sản phẩm bán chạy</h1>
            <p>Những mẫu Figure được khách hàng yêu thích và đặt mua nhiều nhất.</p>
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

            foreach ($bestProducts as $item):
            ?>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">

                            <div class="col-6">
                                <img src="assets/client/img/<?= htmlspecialchars($item['img']) ?>"
                                     class="img-fluid rounded-circle w-100"
                                     alt="<?= htmlspecialchars($item['name']) ?>">
                            </div>

                            <div class="col-6">
                                <a href="index.php?page=product" class="h5">
                                    <?= htmlspecialchars($item['name']) ?>
                                </a>

                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>

                                <h4 class="mb-3"><?= htmlspecialchars($item['price']) ?></h4>

                                <a href="index.php?page=product"
                                   class="btn border border-secondary rounded-pill px-3 text-primary">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i>
                                    Mua ngay
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

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


<style>
.home-post-card{
    border-radius:18px;
    overflow:hidden;
    transition:.3s;
}

.home-post-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(0,0,0,.12)!important;
}

.home-post-img{
    width:100%;
    height:240px;
    object-fit:cover;
}

.home-post-card .card-title a:hover{
    color:#81c408!important;
}
</style>


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

                    if (data && data.success) {
                        var cartCountEl = document.querySelector('#cart-count');

                        if (cartCountEl) {
                            cartCountEl.innerText = typeof data.count !== 'undefined'
                                ? data.count
                                : parseInt(cartCountEl.innerText || '0') + 1;
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