<?php
// Nhận dữ liệu từ ProductController
$product = $product ?? null;
$variants = $variants ?? [];
$relatedProducts = $relatedProducts ?? [];

if (!$product) {
    echo "<div class='container py-5 text-center'><h3>Sản phẩm không tồn tại</h3></div>";
    return;
}

// Xử lý logic hiển thị
$currentPrice = (($product['sale_price'] ?? 0) > 0) ? ($product['sale_price'] ?? 0) : ($product['price'] ?? 0);
$oldPrice = (($product['sale_price'] ?? 0) > 0) ? ($product['price'] ?? 0) : 0;
$mainImage = !empty($product['image']) ? "assets/client/img/" . $product['image'] : 'assets/client/img/no-image.png';
$isOutOfStock = ($product['total_stock'] ?? 0) <= 0;
?>

<main class="product-detail-page">
    <div class="container">
        <nav class="product-breadcrumb">
            <a href="index.php">Trang chủ</a>
            <span>/</span>
            <a href="index.php?page=product">Sản phẩm</a>
            <span>/</span>
            <strong><?= htmlspecialchars($product['name']) ?></strong>
        </nav>

        <section class="product-detail">
            <div class="product-gallery">
                <div class="product-main-image">
                    <img src="<?= $mainImage ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <span><?= htmlspecialchars($product['category_name'] ?? 'Mô hình') ?></span>
                </div>

                <div class="product-thumbs">
                    <button type="button" class="active">
                        <img src="<?= $mainImage ?>" alt="Main Thumb">
                    </button>
                    <?php foreach ($variants as $variant): ?>
                        <button type="button">
                            <img src="assets/client/img/<?= htmlspecialchars($variant['image']) ?>" alt="Variant">
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="product-detail-info">
                <span class="detail-status">Còn hàng - giao nhanh toàn quốc</span>
                <h1><?php echo $product['name']; ?></h1>

                <div class="detail-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span>4.8 | 126 đánh giá</span>
                </div>

                <div class="detail-price">
                    <strong><?= number_format($currentPrice, 0, ',', '.') ?>đ</strong>
                    <?php if ($oldPrice > 0): ?>
                        <del><?= number_format($oldPrice, 0, ',', '.') ?>đ</del>
                    <?php endif; ?>
                </div>

                <p class="detail-desc">
                    <?= nl2br(htmlspecialchars($product['description'] ?? 'Đang cập nhật mô tả cho sản phẩm này.')) ?>
                </p>

                <div class="detail-actions">
                    <div class="detail-quantity">
                        <button type="button">-</button>
                        <input type="number" value="1" min="1">
                        <button type="button">+</button>
                    </div>

                    <button type="button" 
                            class="btn detail-cart-btn add-cart-btn <?= $isOutOfStock ? 'disabled' : '' ?>"
                            data-id="<?= $product['id'] ?>"
                            <?= $isOutOfStock ? 'disabled' : '' ?>>
                        <i class="fa fa-shopping-bag me-2"></i>
                        <?= $isOutOfStock ? 'Hết hàng' : 'Thêm vào giỏ' ?>
                    </button>
                </div>

                <div class="detail-meta">
                    <div><span>Mã sản phẩm</span><strong><?= htmlspecialchars($product['sku'] ?? 'PH-'.$product['id']) ?></strong></div>
                    <div><span>Thương hiệu</span><strong><?= htmlspecialchars($product['brand'] ?? 'Đang cập nhật') ?></strong></div>
                    <div><span>Chiều cao</span><strong><?= htmlspecialchars($product['height'] ?? 'Đang cập nhật') ?></strong></div>
                    <div><span>Chất liệu</span><strong><?= htmlspecialchars($product['material'] ?? 'PVC/ABS') ?></strong></div>
                </div>
                
                <?php if (!empty($variants)): ?>
                <div class="mt-4">
                    <h6>Phiên bản:</h6>
                    <div class="d-flex gap-2">
                        <?php foreach ($variants as $v): ?>
                            <span class="badge border text-dark p-2"><?= htmlspecialchars($v['variant_name']) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="product-detail-tabs">
            <div class="detail-tab-block">
                <h3>Mô tả sản phẩm</h3>
                <p>
                    <?= htmlspecialchars($product['content'] ?? $product['description'] ?? 'Thông tin chi tiết đang được cập nhật.') ?>
                </p>
            </div>

            <div class="detail-tab-block">
                <h3>Chính sách mua hàng</h3>
                <ul>
                    <li>Đổi trả trong 7 ngày nếu sản phẩm lỗi do vận chuyển.</li>
                    <li>Đóng gói chống sốc trước khi giao.</li>
                    <li>Hỗ trợ kiểm tra ảnh thật trước khi gửi hàng.</li>
                </ul>
            </div>
        </section>

        <section class="related-products">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Sản phẩm liên quan</h2>
                <a href="index.php?page=product">Xem tất cả</a>
            </div>

            <div class="row g-4">
                <?php foreach ($relatedProducts as $item): ?>
                    <?php if ($item['id'] == $product['id']) continue; // Bỏ qua sản phẩm hiện tại ?>
                    <?php 
                        $rPrice = (float)(($item['sale_price'] ?? 0) > 0 ? $item['sale_price'] : ($item['price'] ?? 0));
                        // Sửa đường dẫn ảnh cho sản phẩm liên quan
                        $rImage = !empty($item['image']) ? "assets/client/img/" . $item['image'] : 'assets/client/img/no-image.png';
                    ?>
                    <div class="col-md-4">
                        <div class="related-card">
                            <img src="<?= htmlspecialchars($rImage) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                            <div>
                                <span><?= htmlspecialchars($item['category'] ?? 'Mô hình') ?></span>
                                <h4>
                                    <a href="index.php?page=product-detail&id=<?= $item['id'] ?>">
                                        <?= htmlspecialchars($item['name']) ?>
                                    </a>
                                </h4>
                                <strong><?= number_format($rPrice, 0, ',', '.') ?>đ</strong>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>
