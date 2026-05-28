<?php require_once 'Views/client/layouts/Header.php'; ?>

<div class="container-fluid product-shop py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <aside class="product-sidebar">
                    <div class="product-filter">
                        <h4>Danh mục</h4>
                        <a href="#" class="active">Tất cả mô hình <span>24</span></a>
                        <a href="#">Anime Figure <span>10</span></a>
                        <a href="#">Gundam <span>6</span></a>
                        <a href="#">Marvel <span>4</span></a>
                        <a href="#">Pokemon <span>4</span></a>
                    </div>

                    <div class="product-filter">
                        <h4>Khoảng giá</h4>
                        <label class="product-check"><input type="checkbox"><span>Dưới 1.000.000đ</span></label>
                        <label class="product-check"><input type="checkbox"><span>1.000.000đ - 2.000.000đ</span></label>
                        <label class="product-check"><input type="checkbox"><span>Trên 2.000.000đ</span></label>
                    </div>

                    <div class="product-promo">
                        <span>Ưu đãi</span>
                        <h5>Giảm 15% cho đơn mô hình từ 2 sản phẩm</h5>
                        <p>Áp dụng cho figure có sẵn trong kho.</p>
                    </div>
                </aside>
            </div>

            <div class="col-lg-9">
                <div class="product-toolbar">
                    <div>
                        <p class="mb-1 text-primary fw-bold">Bộ sưu tập ASM Figure</p>
                        <h2>Mô hình bán chạy</h2>
                    </div>

                    <div class="product-tools">
                        <div class="product-search">
                            <i class="fa fa-search"></i>
                            <input type="search" placeholder="Tìm mô hình...">
                        </div>

                        <select aria-label="Sắp xếp sản phẩm">
                            <option>Sắp xếp mặc định</option>
                            <option>Giá thấp đến cao</option>
                            <option>Giá cao đến thấp</option>
                            <option>Mới nhất</option>
                        </select>
                    </div>
                </div>

                <div class="row g-4">
                    <?php
                    $products = [
                        ['id' => 1, 'img' => 'luffy-gear-5.jpg', 'tag' => 'One Piece', 'name' => 'Luffy Gear 5 Figure', 'price' => '2.500.000đ', 'status' => 'Còn hàng'],
                        ['id' => 2, 'img' => 'fruite-item-2.jpg', 'tag' => 'Naruto', 'name' => 'Naruto Uzumaki Sage Mode', 'price' => '1.850.000đ', 'status' => 'Còn hàng'],
                        ['id' => 3, 'img' => 'fruite-item-3.webp', 'tag' => 'Dragon Ball', 'name' => 'Son Goku Ultra Instinct', 'price' => '2.200.000đ', 'status' => 'Bán chạy'],
                        ['id' => 4, 'img' => 'fruite-item-4.webp', 'tag' => 'Demon Slayer', 'name' => 'Tanjiro Kamado Figure', 'price' => '1.650.000đ', 'status' => 'Còn hàng'],
                        ['id' => 5, 'img' => 'fruite-item-5.webp', 'tag' => 'Jujutsu Kaisen', 'name' => 'Gojo Satoru Premium', 'price' => '2.900.000đ', 'status' => 'Hot'],
                        ['id' => 6, 'img' => 'fruite-item-6.webp', 'tag' => 'Attack On Titan', 'name' => 'Levi Ackerman Figure', 'price' => '2.750.000đ', 'status' => 'Còn hàng'],
                        ['id' => 7, 'img' => 'best-product-1.jpg', 'tag' => 'Nendoroid', 'name' => 'Nendoroid Anime Collection', 'price' => '950.000đ', 'status' => 'Giá tốt'],
                        ['id' => 8, 'img' => 'best-product-2.jpg', 'tag' => 'Gundam', 'name' => 'Gundam Assembly Model', 'price' => '1.450.000đ', 'status' => 'Mới về'],
                        ['id' => 9, 'img' => 'best-product-3.webp', 'tag' => 'Marvel', 'name' => 'Hero Action Figure', 'price' => '1.990.000đ', 'status' => 'Còn hàng'],
                    ];

                    foreach ($products as $product) {
                    ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="product-card">
                                <a href="index.php?page=product-detail&id=<?php echo $product['id']; ?>" class="product-card-img">
                                    <img src="assets/client/img/<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                                    <span class="product-tag"><?php echo $product['tag']; ?></span>
                                </a>

                                <div class="product-card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="product-status"><?php echo $product['status']; ?></span>
                                        <div class="product-stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                    </div>

                                    <h4>
                                        <a href="index.php?page=product-detail&id=<?php echo $product['id']; ?>" class="text-dark">
                                            <?php echo $product['name']; ?>
                                        </a>
                                    </h4>
                                    <p>Mô hình chi tiết sắc nét, phù hợp trưng bày bàn làm việc và bộ sưu tập cá nhân.</p>

                                    <div class="product-card-bottom">
                                        <strong><?php echo $product['price']; ?></strong>
                                        <a href="index.php?page=product-detail&id=<?php echo $product['id']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary">
                                            <i class="fa fa-eye me-2 text-primary"></i>
                                            Chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'Views/client/layouts/Footer.php'; ?>
