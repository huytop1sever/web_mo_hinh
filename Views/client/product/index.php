<?php require_once 'Views/client/layouts/header.php'; ?>

<?php
$products = $products ?? [];
$categories = $categories ?? [];

$pageNow = isset($pageNow) ? (int)$pageNow : 1;
$totalPages = isset($totalPages) ? (int)$totalPages : 1;

$keyword = $_GET['keyword'] ?? '';
$categoryId = $_GET['category_id'] ?? '';
$priceRange = $_GET['price_range'] ?? '';
$sort = $_GET['sort'] ?? '';
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
                        <input type="text"
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
                            <option value="under_1000000" <?= $priceRange == 'under_1000000' ? 'selected' : '' ?>>
                                Dưới 1.000.000đ
                            </option>
                            <option value="1000000_2000000" <?= $priceRange == '1000000_2000000' ? 'selected' : '' ?>>
                                1.000.000đ - 2.000.000đ
                            </option>
                            <option value="over_2000000" <?= $priceRange == 'over_2000000' ? 'selected' : '' ?>>
                                Trên 2.000.000đ
                            </option>
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
                                    <span><?= $category['total_products'] ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <div class="product-promo">
                        <span>Ưu đãi</span>
                        <h5>Giảm 15% cho đơn mô hình từ 2 sản phẩm</h5>
                        <p>Áp dụng cho figure có sẵn trong kho.</p>
                    </div>
                </aside>
            </div>

            <div class="col-lg-9">
                <div class="row g-4">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <?php
                            $id = $product['id'];
                            $name = $product['name'];
                            $price = 0;
                            $oldPrice = 0;

                            if (!empty($product['sale_price']) && $product['sale_price'] > 0) {
                                $price = $product['sale_price'];
                                $oldPrice = $product['price'];
                            } elseif (!empty($product['price'])) {
                                $price = $product['price'];
                            }

                            // Sửa lỗi syntax và đường dẫn ảnh
                            $image = (!empty($product['image'])) 
                                ? "assets/client/img/" . $product['image'] 
                                : "assets/client/img/no-image.png";
                            
                            $isOutOfStock = ($product['total_stock'] ?? 0) <= 0;
                            $statusText = $isOutOfStock ? 'Hết hàng' : 'Còn hàng';
                            $statusClass = $isOutOfStock ? 'text-danger' : 'text-success';
                            ?>
                            <div class="col-md-6 col-xl-4">
                                <div class="product-card position-relative">
                                    <div class="product-img">
                                        <a href="index.php?page=product-detail&id=<?= htmlspecialchars($id) ?>">
                                            <img src="<?= htmlspecialchars($image) ?>"
                                                 alt="<?= htmlspecialchars($name) ?>">
                                        </a>
                                        <span><?= htmlspecialchars($product['category'] ?? 'Mô hình') ?></span>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-top">
                                            <b class="<?= $statusClass ?>"><?= $statusText ?></b>
                                            <div>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                        </div>
                                        <h4 class="product-title">
                                            <a href="index.php?page=product-detail&id=<?= htmlspecialchars($id) ?>" class="stretched-link">
                                                <?= htmlspecialchars($name) ?>
                                            </a>
                                        </h4>
                                        <p><?= htmlspecialchars($product['description'] ?? '') ?></p>
                                        <h3>
                                            <?php if (!empty($oldPrice)): ?>
                                                <del><?= number_format($oldPrice, 0, ',', '.') ?>đ</del>
                                            <?php endif; ?>

                                            <?= number_format($price, 0, ',', '.') ?>đ
                                        </h3>
                                        <div class="product-actions">
                                            <button type="button"
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
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <i class="fa fa-search fa-3x text-muted mb-3"></i>
                            <p>Không tìm thấy sản phẩm nào phù hợp với yêu cầu của bạn.</p>
                            <a href="index.php?page=product" class="btn btn-primary mt-2">Xem tất cả sản phẩm</a>
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
.product-sidebar {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.product-sidebar h4 {
    font-size: 1.15rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: #2c3e50;
    border-left: 4px solid #81c408;
    padding-left: 12px;
}

.product-sidebar input[type="text"],
.product-sidebar select {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.product-sidebar input[type="text"]:focus,
.product-sidebar select:focus {
    background-color: #fff;
    border-color: #81c408;
    box-shadow: 0 0 0 3px rgba(129, 196, 8, 0.1);
    outline: none;
}

.product-filter a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    color: #555;
    text-decoration: none;
    transition: color 0.2s;
    border-bottom: 1px solid #f1f1f1;
}

.product-filter a:hover,
.product-filter a.active {
    color: #81c408;
    font-weight: 600;
}

.product-filter a span {
    font-size: 0.8rem;
    color: #999;
    background: #f0f0f0;
    padding: 2px 8px;
    border-radius: 10px;
}

.product-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 3rem;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
    line-height: 1.5rem;
}
.product-title a {
    color: inherit;
    text-decoration: none;
}
.product-title a:hover {
    color: #81c408;
}
.add-cart-btn.disabled {
    background-color: #6c757d;
    border-color: #6c757d;
    cursor: not-allowed;
    opacity: 0.65;
}
.product-actions {
    position: relative;
    z-index: 2; /* Đảm bảo các nút bấm vẫn hoạt động khi dùng stretched-link */
}
.product-promo {
    margin-top: 30px;
    background: #fafff0;
    border: 1px dashed #81c408;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}
</style>

<div id="toast"></div>
<script>
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const item = document.createElement('div');
    item.className = 'toast-item toast-' + type;
    item.innerHTML = message;
    toast.appendChild(item);
    setTimeout(() => {
        item.remove();
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.querySelector('.product-filter');
    const sortSelect = document.querySelector('select[name="sort"]');
    const priceRangeSelect = document.querySelector('select[name="price_range"]');

    // Tự động gửi form khi thay đổi lựa chọn sắp xếp
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            filterForm.submit();
        });
    }

    // Tự động gửi form khi thay đổi lựa chọn khoảng giá
    if (priceRangeSelect) {
        priceRangeSelect.addEventListener('change', function() {
            filterForm.submit();
        });
    }
});

document.querySelectorAll('.add-cart-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        let id = this.dataset.id;

        fetch('index.php?page=cart&action=add&id=' + id)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('✓ Đã thêm sản phẩm vào giỏ hàng', 'success');
                } else {
                    showToast('✕ Thêm vào giỏ hàng thất bại', 'error');
                }
            })
            .catch(() => {
                showToast('✕ Thêm vào giỏ hàng thất bại', 'error');
            });
    });
});
</script>
<?php require_once 'Views/client/layouts/footer.php'; ?>