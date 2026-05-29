<?php require_once 'Views/client/layouts/Header.php'; ?>

<?php
$products = [
    1 => ['img' => 'luffy-gear-5.jpg', 'tag' => 'One Piece', 'name' => 'Luffy Gear 5 Figure', 'price' => '2.500.000đ', 'old_price' => '2.850.000đ', 'sku' => 'OP-LFY-G5', 'height' => '28 cm', 'material' => 'PVC/ABS cao cấp', 'brand' => 'Bandai Spirits'],
    2 => ['img' => 'fruite-item-2.jpg', 'tag' => 'Naruto', 'name' => 'Naruto Uzumaki Sage Mode', 'price' => '1.850.000đ', 'old_price' => '2.100.000đ', 'sku' => 'NR-SGM-02', 'height' => '24 cm', 'material' => 'PVC sơn tĩnh điện', 'brand' => 'Megahouse'],
    3 => ['img' => 'fruite-item-3.webp', 'tag' => 'Dragon Ball', 'name' => 'Son Goku Ultra Instinct', 'price' => '2.200.000đ', 'old_price' => '2.550.000đ', 'sku' => 'DB-GKU-UI', 'height' => '26 cm', 'material' => 'PVC/ABS', 'brand' => 'S.H.Figuarts'],
    4 => ['img' => 'fruite-item-4.webp', 'tag' => 'Demon Slayer', 'name' => 'Tanjiro Kamado Figure', 'price' => '1.650.000đ', 'old_price' => '1.900.000đ', 'sku' => 'DS-TNJ-04', 'height' => '22 cm', 'material' => 'PVC', 'brand' => 'Aniplex'],
    5 => ['img' => 'fruite-item-5.webp', 'tag' => 'Jujutsu Kaisen', 'name' => 'Gojo Satoru Premium', 'price' => '2.900.000đ', 'old_price' => '3.250.000đ', 'sku' => 'JJK-GJO-05', 'height' => '27 cm', 'material' => 'PVC/ABS', 'brand' => 'Good Smile'],
    6 => ['img' => 'fruite-item-6.webp', 'tag' => 'Attack On Titan', 'name' => 'Levi Ackerman Figure', 'price' => '2.750.000đ', 'old_price' => '3.000.000đ', 'sku' => 'AOT-LVI-06', 'height' => '25 cm', 'material' => 'PVC', 'brand' => 'Kotobukiya'],
    7 => ['img' => 'best-product-1.jpg', 'tag' => 'Nendoroid', 'name' => 'Nendoroid Anime Collection', 'price' => '950.000đ', 'old_price' => '1.150.000đ', 'sku' => 'NEN-COL-07', 'height' => '10 cm', 'material' => 'PVC/ABS', 'brand' => 'Good Smile'],
    8 => ['img' => 'best-product-2.jpg', 'tag' => 'Gundam', 'name' => 'Gundam Assembly Model', 'price' => '1.450.000đ', 'old_price' => '1.700.000đ', 'sku' => 'GDM-MDL-08', 'height' => '18 cm', 'material' => 'Nhựa PS/ABS', 'brand' => 'Bandai'],
    9 => ['img' => 'best-product-3.webp', 'tag' => 'Marvel', 'name' => 'Hero Action Figure', 'price' => '1.990.000đ', 'old_price' => '2.300.000đ', 'sku' => 'MVL-HAF-09', 'height' => '23 cm', 'material' => 'PVC/ABS', 'brand' => 'Hot Toys'],
];

$id = (int)($_GET['id'] ?? 1);
$product = $products[$id] ?? $products[1];
$gallery = [$product['img'], 'goku.jpg', 'goku1.jpg'];
?>

<main class="product-detail-page">
    <div class="container">
        <nav class="product-breadcrumb">
            <a href="index.php">Trang chủ</a>
            <span>/</span>
            <a href="index.php?page=product">Sản phẩm</a>
            <span>/</span>
            <strong><?php echo $product['name']; ?></strong>
        </nav>

        <section class="product-detail">
            <div class="product-gallery">
                <div class="product-main-image">
                    <img src="assets/client/img/<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                    <span><?php echo $product['tag']; ?></span>
                </div>

                <div class="product-thumbs">
                    <?php foreach ($gallery as $image) { ?>
                        <button type="button">
                            <img src="assets/client/img/<?php echo $image; ?>" alt="<?php echo $product['name']; ?>">
                        </button>
                    <?php } ?>
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
                    <strong><?php echo $product['price']; ?></strong>
                    <del><?php echo $product['old_price']; ?></del>
                </div>

                <p class="detail-desc">
                    Mô hình được hoàn thiện sắc nét, màu sơn đều, dáng đứng chắc chắn và phù hợp để trưng bày trong tủ kính,
                    bàn làm việc hoặc bộ sưu tập nhân vật yêu thích.
                </p>

                <div class="detail-actions">
                    <div class="detail-quantity">
                        <button type="button">-</button>
                        <input type="number" value="1" min="1">
                        <button type="button">+</button>
                    </div>

                    <a href="index.php?page=cart" class="btn detail-cart-btn">
                        <i class="fa fa-shopping-bag me-2"></i>
                        Thêm vào giỏ
                    </a>
                </div>

                <div class="detail-meta">
                    <div><span>Mã sản phẩm</span><strong><?php echo $product['sku']; ?></strong></div>
                    <div><span>Thương hiệu</span><strong><?php echo $product['brand']; ?></strong></div>
                    <div><span>Chiều cao</span><strong><?php echo $product['height']; ?></strong></div>
                    <div><span>Chất liệu</span><strong><?php echo $product['material']; ?></strong></div>
                </div>
            </div>
        </section>

        <section class="product-detail-tabs">
            <div class="detail-tab-block">
                <h3>Mô tả sản phẩm</h3>
                <p>
                    Sản phẩm thuộc dòng figure sưu tầm cao cấp, có hộp bảo vệ, phụ kiện đi kèm và tem kiểm định.
                    Các chi tiết như gương mặt, trang phục, hiệu ứng chuyển động được xử lý kỹ để tạo cảm giác sống động khi trưng bày.
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
                <?php foreach (array_slice($products, 0, 3, true) as $relatedId => $item) { ?>
                    <div class="col-md-4">
                        <div class="related-card">
                            <img src="assets/client/img/<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>">
                            <div>
                                <span><?php echo $item['tag']; ?></span>
                                <h4>
                                    <a href="index.php?page=product-detail&id=<?php echo $relatedId; ?>">
                                        <?php echo $item['name']; ?>
                                    </a>
                                </h4>
                                <strong><?php echo $item['price']; ?></strong>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>
</main>

<?php require_once 'Views/client/layouts/Footer.php'; ?>
