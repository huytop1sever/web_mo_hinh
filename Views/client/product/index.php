<?php require_once 'Views/client/layouts/header.php'; ?>

<?php
$products = $products ?? [];
$categories = $categories ?? [];

$pageNow = isset($pageNow) ? (int)$pageNow : 1;
$totalPages = isset($totalPages) ? (int)$totalPages : 1;

$keyword = $_GET['keyword'] ?? '';
$categoryId = $_GET['category_id'] ?? '';
$priceRange = $_GET['price_range'] ?? '';
?>

<div class="container-fluid product-shop py-5">
    <div class="container py-5">
        <div class="row g-4">

            <div class="col-lg-3">
                <aside class="product-sidebar">

                    <form method="get" action="index.php" class="product-filter">
                        <input type="hidden" name="page" value="products">

                        <h4>Tìm kiếm</h4>

                        <input type="text"
                               name="keyword"
                               placeholder="Tên sản phẩm..."
                               value="<?= htmlspecialchars($keyword) ?>">

                        <?php if (!empty($categoryId)): ?>
                            <input type="hidden" name="category_id" value="<?= htmlspecialchars($categoryId) ?>">
                        <?php endif; ?>

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
                            Tìm kiếm
                        </button>

                        <a href="index.php?page=products" class="btn btn-light w-100 mt-2">
                            Làm mới
                        </a>
                    </form>

                    <div class="product-filter">
                        <h4>Danh mục</h4>

                        <a href="index.php?page=products&keyword=<?= urlencode($keyword) ?>&price_range=<?= urlencode($priceRange) ?>"
                           class="<?= empty($categoryId) ? 'active' : '' ?>">
                            Tất cả mô hình
                        </a>

                        <?php foreach ($categories as $category): ?>
                            <a href="index.php?page=products&category_id=<?= htmlspecialchars($category['id']) ?>&keyword=<?= urlencode($keyword) ?>&price_range=<?= urlencode($priceRange) ?>"
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
                            $price = 0;
                            $oldPrice = 0;

                            if (!empty($product['sale_price']) && $product['sale_price'] > 0) {
                                $price = $product['sale_price'];
                                $oldPrice = $product['price'];
                            } elseif (!empty($product['price'])) {
                                $price = $product['price'];
                            }

                            $image = !empty($product['image'])
                                ? $product['image']
                                : 'assets/client/img/no-image.png';

                            $status = (($product['total_stock'] ?? 0) > 0)
                                ? 'Còn hàng'
                                : 'Hết hàng';
                            ?>

                            <div class="col-md-6 col-xl-4">
                                <div class="product-card">

                                    <div class="product-img">
                                        <img src="<?= htmlspecialchars($image) ?>"
                                             alt="<?= htmlspecialchars($product['name']) ?>">

                                        <span><?= htmlspecialchars($product['category'] ?? 'Mô hình') ?></span>
                                    </div>

                                    <div class="product-content">

                                        <div class="product-top">
                                            <b><?= $status ?></b>

                                            <div>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                        </div>

                                        <h4><?= htmlspecialchars($product['name']) ?></h4>

                                        <p><?= htmlspecialchars($product['description'] ?? '') ?></p>

                                        <h3>
                                            <?php if (!empty($oldPrice)): ?>
                                                <del><?= number_format($oldPrice, 0, ',', '.') ?>đ</del>
                                            <?php endif; ?>

                                            <?= number_format($price, 0, ',', '.') ?>đ
                                        </h3>

                                        <div class="product-actions">
                                            <button type="button"
                                                    class="add-cart-btn"
                                                    data-id="<?= htmlspecialchars($product['id']) ?>">
                                                <i class="fa fa-shopping-bag"></i>
                                                Thêm vào giỏ
                                            </button>

                                            <a href="index.php?page=product-detail&id=<?= htmlspecialchars($product['id']) ?>">
                                                <i class="fa fa-eye"></i>
                                                Chi tiết
                                            </a>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>
                        <div class="col-12">
                            <p>Không có sản phẩm nào.</p>
                        </div>
                    <?php endif; ?>

                </div>

                <?php if ($totalPages > 1): ?>
                    <ul class="product-pagination">

                        <?php if ($pageNow > 1): ?>
                            <li>
                                <a href="index.php?page=products&p=<?= $pageNow - 1 ?>&category_id=<?= urlencode($categoryId) ?>&keyword=<?= urlencode($keyword) ?>&price_range=<?= urlencode($priceRange) ?>">
                                    Trước
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="<?= ($pageNow == $i) ? 'active' : '' ?>">
                                <a href="index.php?page=products&p=<?= $i ?>&category_id=<?= urlencode($categoryId) ?>&keyword=<?= urlencode($keyword) ?>&price_range=<?= urlencode($priceRange) ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($pageNow < $totalPages): ?>
                            <li>
                                <a href="index.php?page=products&p=<?= $pageNow + 1 ?>&category_id=<?= urlencode($categoryId) ?>&keyword=<?= urlencode($keyword) ?>&price_range=<?= urlencode($priceRange) ?>">
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