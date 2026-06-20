<?php
$products = $products ?? [];
$categories = $categories ?? [];

$pageNow = isset($pageNow) ? (int)$pageNow : 1;
$totalPages = isset($totalPages) ? (int)$totalPages : 1;

$keyword = $_GET['keyword'] ?? '';
$categoryId = $_GET['category_id'] ?? '';
$priceRange = $_GET['price_range'] ?? '';
$sort = $_GET['sort'] ?? '';

$fallbackImage = 'uploads/products/1781846482_gojo.webp';
?>

<div class="container-fluid product-shop py-5">
    <div class="container py-5">

        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-3">
                <aside class="product-sidebar">

                    <form method="get" action="index.php" class="product-filter">
                        <input type="hidden" name="page" value="product">

                        <h4>Tìm kiếm</h4>

                        <input
                            type="text"
                            name="keyword"
                            placeholder="Tên sản phẩm..."
                            value="<?= htmlspecialchars($keyword) ?>">

                        <input type="hidden" name="category_id" value="<?= htmlspecialchars($categoryId) ?>">

                        <h4 class="mt-4">Sắp xếp theo</h4>

                        <select name="sort">
                            <option value="">Mặc định</option>
                            <option value="price_asc" <?= $sort == 'price_asc' ? 'selected' : '' ?>>Giá: Thấp đến Cao</option>
                            <option value="price_desc" <?= $sort == 'price_desc' ? 'selected' : '' ?>>Giá: Cao đến Thấp</option>
                            <option value="name_asc" <?= $sort == 'name_asc' ? 'selected' : '' ?>>Tên: A - Z</option>
                            <option value="name_desc" <?= $sort == 'name_desc' ? 'selected' : '' ?>>Tên: Z - A</option>
                        </select>

                        <select name="price_range">
                            <option value="">Tất cả giá</option>
                            <option value="under_1000000" <?= $priceRange == 'under_1000000' ? 'selected' : '' ?>>Dưới 1.000.000đ</option>
                            <option value="1000000_2000000" <?= $priceRange == '1000000_2000000' ? 'selected' : '' ?>>1.000.000đ - 2.000.000đ</option>
                            <option value="over_2000000" <?= $priceRange == 'over_2000000' ? 'selected' : '' ?>>Trên 2.000.000đ</option>
                        </select>

                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            Lọc sản phẩm
                        </button>
                    </form>

                    <div class="product-filter">
                        <h4>Danh mục</h4>

                        <a href="index.php?page=product&keyword=<?= urlencode($keyword) ?>&price_range=<?= urlencode($priceRange) ?>&sort=<?= urlencode($sort) ?>"
                           class="<?= empty($categoryId) ? 'active' : '' ?>">
                            Tất cả mô hình
                        </a>

                        <?php foreach ($categories as $category): ?>
                            <a href="index.php?page=product&category_id=<?= htmlspecialchars($category['id']) ?>&keyword=<?= urlencode($keyword) ?>&price_range=<?= urlencode($priceRange) ?>&sort=<?= urlencode($sort) ?>"
                               class="<?= ($categoryId == $category['id']) ? 'active' : '' ?>">
                                <?= htmlspecialchars($category['name']) ?>

                                <?php if (isset($category['total_products'])): ?>
                                    <span><?= htmlspecialchars($category['total_products']) ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                </aside>
            </div>

            <div class="col-lg-9">
                <div class="row g-4">

                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <?php
                            $id = $product['id'] ?? 0;
                            $name = $product['name'] ?? $product['title'] ?? '';

                            $price = $product['price'] ?? 0;
                            $salePrice = $product['sale_price'] ?? 0;

                            $image = $fallbackImage;
                            if (!empty($product['image'])) {
                                $image = $product['image'];
                                if (!str_contains($image, 'uploads/') && !str_contains($image, 'assets/') && !str_contains($image, 'http')) {
                                    $image = 'uploads/products/' . $image;
                                }
                            }

                            $stock = (int)($product['total_stock'] ?? $product['stock'] ?? 1);
                            $isOutOfStock = $stock <= 0;

                            $statusText = $isOutOfStock ? 'Hết hàng' : 'Còn hàng';
                            $statusClass = $isOutOfStock ? 'text-danger' : 'text-success';
                            ?>

                            <div class="col-md-6 col-xl-4">
                                <div class="product-card">

                                    <a href="index.php?page=product-detail&id=<?= htmlspecialchars($id) ?>"
                                       class="product-click-link">

                                        <div class="product-img">
                                            <img src="<?= htmlspecialchars($image) ?>"
                                                 alt="<?= htmlspecialchars($name) ?>"
                                                 onerror="this.src='<?= $fallbackImage ?>'">

                                            <span><?= htmlspecialchars($product['category'] ?? 'Mô hình') ?></span>
                                        </div>

                                        <div class="product-content">

                                            <div class="product-top">
                                                <b class="<?= htmlspecialchars($statusClass) ?>">
                                                    <?= htmlspecialchars($statusText) ?>
                                                </b>

                                                <div class="product-stars">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                            </div>

                                            <h4 class="product-title">
                                                <?= htmlspecialchars($name) ?>
                                            </h4>

                                            <div class="product-price">
                                                <?php if (!empty($salePrice) && $salePrice > 0): ?>
                                                    <div class="old-price">
                                                        <?= number_format($price, 0, ',', '.') ?>đ
                                                    </div>

                                                    <div class="new-price">
                                                        <?= number_format($salePrice, 0, ',', '.') ?>đ
                                                    </div>
                                                <?php else: ?>
                                                    <div class="old-price empty-price">&nbsp;</div>

                                                    <div class="new-price">
                                                        <?= number_format($price, 0, ',', '.') ?>đ
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </a>

                                    <div class="product-actions">
                                        <button
                                            type="button"
                                            class="add-cart-btn <?= $isOutOfStock ? 'disabled' : '' ?>"
                                            data-id="<?= htmlspecialchars($id) ?>"
                                            <?= $isOutOfStock ? 'disabled' : '' ?>>
                                            <i class="fa fa-shopping-bag"></i>
                                            <?= $isOutOfStock ? 'Hết hàng' : 'Thêm vào giỏ' ?>
                                        </button>

                                        <a href="index.php?page=product-detail&id=<?= htmlspecialchars($id) ?>">
                                            <i class="fa fa-eye"></i>
                                            Chi tiết
                                        </a>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <i class="fa fa-search fa-3x text-muted mb-3"></i>
                            <p>Không tìm thấy sản phẩm nào phù hợp với yêu cầu của bạn.</p>
                            <a href="index.php?page=product" class="btn btn-primary mt-2">
                                Xem tất cả sản phẩm
                            </a>
                        </div>
                    <?php endif; ?>

                </div>

                <?php if ($totalPages > 1): ?>
                    <ul class="product-pagination mt-5">
                        <?php if ($pageNow > 1): ?>
                            <li>
                                <a href="index.php?page=product&p=<?= $pageNow - 1 ?>&category_id=<?= htmlspecialchars($categoryId) ?>&keyword=<?= urlencode($keyword) ?>&price_range=<?= urlencode($priceRange) ?>&sort=<?= urlencode($sort) ?>">
                                    Trước
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="<?= ($pageNow === $i) ? 'active' : '' ?>">
                                <a href="index.php?page=product&p=<?= $i ?>&category_id=<?= htmlspecialchars($categoryId) ?>&keyword=<?= urlencode($keyword) ?>&price_range=<?= urlencode($priceRange) ?>&sort=<?= urlencode($sort) ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($pageNow < $totalPages): ?>
                            <li>
                                <a href="index.php?page=product&p=<?= $pageNow + 1 ?>&category_id=<?= htmlspecialchars($categoryId) ?>&keyword=<?= urlencode($keyword) ?>&price_range=<?= urlencode($priceRange) ?>&sort=<?= urlencode($sort) ?>">
                                    Sau
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<style>
.product-shop {
    background: #fff;
}

.product-filter {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 26px;
    margin-bottom: 24px;
    box-shadow: 0 8px 24px rgba(0,0,0,.04);
}

.product-filter h4 {
    font-size: 30px;
    font-weight: 700;
    color: #3f5557;
    margin-bottom: 20px;
}

.product-filter input,
.product-filter select {
    width: 100%;
    height: 42px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 0 12px;
    margin-bottom: 12px;
}

.product-filter a {
    display: flex;
    justify-content: space-between;
    color: #666;
    padding: 12px 0;
    border-bottom: 1px solid #e5e7eb;
    text-decoration: none;
}

.product-filter a.active,
.product-filter a:hover {
    color: #81c408;
}

.product-card {
    height: 100%;
    min-height: 520px;
    display: flex;
    flex-direction: column;
    border: 1px solid #ffb524;
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    transition: .3s;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 35px rgba(0,0,0,.12);
}

.product-click-link {
    display: flex;
    flex-direction: column;
    flex: 1;
    color: inherit;
    text-decoration: none;
}

.product-click-link:hover {
    color: inherit;
    text-decoration: none;
}

.product-img {
    height: 270px;
    position: relative;
    overflow: hidden;
}

.product-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-img span {
    position: absolute;
    left: 18px;
    bottom: 16px;
    background: #81c408;
    color: #fff;
    padding: 8px 18px;
    border-radius: 20px;
    font-weight: 700;
}

.product-content {
    padding: 24px 28px 10px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}

.product-stars i {
    color: #ffb524;
}

.product-title {
    font-size: 24px;
    color: #3f5557;
    margin-bottom: 18px;
    min-height: 58px;
    line-height: 1.25;
}

.product-price {
    margin-top: auto;
    min-height: 58px;
}

.old-price {
    height: 22px;
    font-size: 16px;
    color: #999;
    text-decoration: line-through;
    font-weight: 600;
    margin-bottom: 2px;
}

.empty-price {
    text-decoration: none;
    visibility: hidden;
}

.new-price {
    font-size: 26px;
    font-weight: 700;
    color: #81c408;
    line-height: 1.2;
}

.product-actions {
    display: flex;
    gap: 10px;
    padding: 18px 28px 28px;
    position: relative;
    z-index: 5;
}

.product-actions button,
.product-actions a {
    flex: 1;
    border: 1px solid #ffb524;
    background: #fff;
    color: #81c408;
    border-radius: 24px;
    padding: 10px 12px;
    text-align: center;
    font-weight: 600;
    text-decoration: none;
}

.product-actions button:hover,
.product-actions a:hover {
    background: #81c408;
    color: #fff;
}

.product-actions button.disabled {
    color: #dc3545;
    cursor: not-allowed;
}

.product-pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    list-style: none;
    padding-left: 0;
}

.product-pagination a {
    display: block;
    padding: 8px 14px;
    border: 1px solid #ffb524;
    border-radius: 8px;
    color: #81c408;
    text-decoration: none;
}

.product-pagination .active a,
.product-pagination a:hover {
    background: #81c408;
    color: #fff;
}
</style>

<div id="toast"></div>

<script src="assets/client/js/product.js"></script>