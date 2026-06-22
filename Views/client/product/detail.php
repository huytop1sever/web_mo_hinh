<?php
$product = $product ?? null;
$variants = $variants ?? [];
$productImages = $productImages ?? [];
$relatedProducts = $relatedProducts ?? [];

if (!$product) {
    echo "<div class='container py-5 text-center'><h3>Sản phẩm không tồn tại</h3></div>";
    return;
}

$fallbackImage = 'uploads/products/1781846482_gojo.webp';

$mainImage = $fallbackImage;
if (!empty($product['image'])) {
    $mainImage = $product['image'];
    if (!str_contains($mainImage, 'uploads/')) {
        $mainImage = 'uploads/products/' . $mainImage;
    }
}

$firstVariant = $variants[0] ?? null;

$currentPrice = 0;
$oldPrice = 0;

if ($firstVariant) {
    $currentPrice = !empty($firstVariant['sale_price']) && $firstVariant['sale_price'] > 0
        ? $firstVariant['sale_price']
        : $firstVariant['price'];

    $oldPrice = !empty($firstVariant['sale_price']) && $firstVariant['sale_price'] > 0
        ? $firstVariant['price']
        : 0;
} else {
    $currentPrice = !empty($product['sale_price']) && $product['sale_price'] > 0
        ? $product['sale_price']
        : ($product['price'] ?? 0);

    $oldPrice = !empty($product['sale_price']) && $product['sale_price'] > 0
        ? ($product['price'] ?? 0)
        : 0;
}

$totalStock = 0;
foreach ($variants as $variant) {
    $totalStock += (int)($variant['stock'] ?? 0);
}

if ($totalStock <= 0 && isset($product['total_stock'])) {
    $totalStock = (int)$product['total_stock'];
}

$isOutOfStock = $totalStock <= 0;
?>

<main class="product-detail-page">
    <div class="container">
        <nav class="product-breadcrumb">
            <a href="index.php">Trang chủ</a>
            <span>/</span>
            <a href="index.php?page=product">Sản phẩm</a>
            <span>/</span>
            <strong><?= htmlspecialchars($product['name'] ?? $product['title'] ?? '') ?></strong>
        </nav>

        <section class="product-detail">
            <div class="product-gallery">
                <div class="product-main-image">
                    <img
                        id="mainProductImage"
                        src="<?= htmlspecialchars($mainImage) ?>"
                        alt="<?= htmlspecialchars($product['name'] ?? $product['title'] ?? '') ?>"
                        onerror="this.src='<?= $fallbackImage ?>'">

                    <span><?= htmlspecialchars($product['category_name'] ?? $product['category'] ?? 'Mô hình') ?></span>
                </div>

                <div class="product-thumbs">
                    <button type="button" class="active" onclick="changeMainImage(this)">
                        <img src="<?= htmlspecialchars($mainImage) ?>" alt="Ảnh chính">
                    </button>

                    <?php foreach ($productImages as $img): ?>
                        <?php if (!empty($img['image'])): ?>
                            <?php
                            $subImage = $img['image'];
                            if (!str_contains($subImage, 'uploads/')) {
                                $subImage = 'uploads/products/' . $subImage;
                            }
                            ?>
                            <button type="button" onclick="changeMainImage(this)">
                                <img src="<?= htmlspecialchars($subImage) ?>" alt="Ảnh phụ">
                            </button>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="product-detail-info">
                <span class="detail-status" id="stockStatus">
                    <?= $isOutOfStock ? 'Hết hàng' : 'Còn hàng - giao nhanh toàn quốc' ?>
                </span>

                <h1><?= htmlspecialchars($product['name'] ?? $product['title'] ?? '') ?></h1>

                <div class="detail-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span>4.8 | 126 đánh giá</span>
                </div>

                <div class="detail-price">
                    <strong id="variantPrice"><?= number_format($currentPrice, 0, ',', '.') ?>đ</strong>

                    <del id="variantOldPrice" style="<?= $oldPrice > 0 ? '' : 'display:none;' ?>">
                        <?= number_format($oldPrice, 0, ',', '.') ?>đ
                    </del>
                </div>

                <p class="detail-desc">
                    <?= nl2br(htmlspecialchars($product['description'] ?? 'Đang cập nhật mô tả cho sản phẩm này.')) ?>
                </p>

                <?php if (!empty($variants)): ?>
                    <div class="mt-4 product-variant-box">
                        <h6>Phiên bản:</h6>

                        <div class="d-flex gap-2 flex-wrap">
                            <?php foreach ($variants as $index => $v): ?>
                                <?php
                                $vPrice = !empty($v['sale_price']) && $v['sale_price'] > 0 ? $v['sale_price'] : $v['price'];
                                $vOldPrice = !empty($v['sale_price']) && $v['sale_price'] > 0 ? $v['price'] : 0;
                                $vStock = (int)($v['stock'] ?? 0);
                                ?>

                                <button
                                    type="button"
                                    class="variant-btn badge border text-dark p-2 <?= $index === 0 ? 'active' : '' ?>"
                                    data-id="<?= htmlspecialchars($v['id']) ?>"
                                    data-name="<?= htmlspecialchars($v['variant_name'] ?? '') ?>"
                                    data-price="<?= htmlspecialchars($vPrice) ?>"
                                    data-old-price="<?= htmlspecialchars($vOldPrice) ?>"
                                    data-stock="<?= htmlspecialchars($vStock) ?>">
                                    <?= htmlspecialchars($v['variant_name'] ?? 'Biến thể') ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="detail-actions">
                    <div class="detail-quantity">
                        <button type="button" onclick="changeQty(-1)">-</button>
                        <input id="quantityInput" type="number" value="1" min="1">
                        <button type="button" onclick="changeQty(1)">+</button>
                    </div>

                    <button
                        type="button"
                        id="addCartBtn"
                        class="btn detail-cart-btn add-cart-btn <?= $isOutOfStock ? 'disabled' : '' ?>"
                        data-id="<?= htmlspecialchars($product['id']) ?>"
                        data-variant-id="<?= htmlspecialchars($firstVariant['id'] ?? '') ?>"
                        <?= $isOutOfStock ? 'disabled' : '' ?>>
                        <i class="fa fa-shopping-bag me-2"></i>
                        <?= $isOutOfStock ? 'Hết hàng' : 'Thêm vào giỏ' ?>
                    </button>
                </div>

                <div class="detail-meta">
                    <div>
                        <span>Mã sản phẩm</span>
                        <strong id="variantSku">
                            <?= htmlspecialchars($firstVariant['sku'] ?? $product['sku'] ?? 'PH-' . $product['id']) ?>
                        </strong>
                    </div>

                    <div>
                        <span>Tồn kho</span>
                        <strong id="variantStock">
                            <?= htmlspecialchars($firstVariant['stock'] ?? $totalStock) ?>
                        </strong>
                    </div>

                    <div>
                        <span>Thương hiệu</span>
                        <strong><?= htmlspecialchars($product['brand'] ?? 'Đang cập nhật') ?></strong>
                    </div>

                    <div>
                        <span>Chất liệu</span>
                        <strong><?= htmlspecialchars($product['material'] ?? 'PVC/ABS') ?></strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="product-detail-tabs">
            <div class="detail-tab-block">
                <h3>Mô tả sản phẩm</h3>
                <p>
                    <?= nl2br(htmlspecialchars($product['content'] ?? $product['description'] ?? 'Thông tin chi tiết đang được cập nhật.')) ?>
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
                    <?php if (($item['id'] ?? 0) == ($product['id'] ?? 0)) continue; ?>

                    <?php
                    $rPrice = (float)(($item['sale_price'] ?? 0) > 0 ? $item['sale_price'] : ($item['price'] ?? 0));
                    $rImage = $fallbackImage;

                    if (!empty($item['image'])) {
                        $rImage = $item['image'];
                        if (!str_contains($rImage, 'uploads/')) {
                            $rImage = 'uploads/products/' . $rImage;
                        }
                    }
                    ?>

                    <div class="col-md-4">
                        <div class="related-card">
                            <img
                                src="<?= htmlspecialchars($rImage) ?>"
                                alt="<?= htmlspecialchars($item['name'] ?? $item['title'] ?? '') ?>"
                                onerror="this.src='<?= $fallbackImage ?>'">

                            <div>
                                <span><?= htmlspecialchars($item['category'] ?? 'Mô hình') ?></span>

                                <h4>
                                    <a href="index.php?page=product-detail&id=<?= htmlspecialchars($item['id']) ?>">
                                        <?= htmlspecialchars($item['name'] ?? $item['title'] ?? '') ?>
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

<script>
function formatMoney(number) {
    return Number(number).toLocaleString('vi-VN') + 'đ';
}

function changeMainImage(button) {
    const img = button.querySelector('img');
    const mainImage = document.getElementById('mainProductImage');

    if (!img || !mainImage) return;

    mainImage.src = img.src;

    document.querySelectorAll('.product-thumbs button').forEach(btn => {
        btn.classList.remove('active');
    });

    button.classList.add('active');
}

function changeQty(number) {
    const input = document.getElementById('quantityInput');
    let value = parseInt(input.value || 1);

    value += number;

    if (value < 1) {
        value = 1;
    }

    input.value = value;
}

document.addEventListener('DOMContentLoaded', function () {
    const addCartBtn = document.getElementById('addCartBtn');

    document.querySelectorAll('.variant-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.variant-btn').forEach(item => {
                item.classList.remove('active');
            });

            this.classList.add('active');

            const variantId = this.dataset.id;
            const price = this.dataset.price;
            const oldPrice = this.dataset.oldPrice;
            const stock = parseInt(this.dataset.stock || 0);

            document.getElementById('variantPrice').innerText = formatMoney(price);
            document.getElementById('variantStock').innerText = stock;

            const oldPriceEl = document.getElementById('variantOldPrice');

            if (oldPrice > 0) {
                oldPriceEl.innerText = formatMoney(oldPrice);
                oldPriceEl.style.display = 'inline';
            } else {
                oldPriceEl.style.display = 'none';
            }

            if (addCartBtn) {
                addCartBtn.dataset.variantId = variantId;

                if (stock <= 0) {
                    addCartBtn.disabled = true;
                    addCartBtn.classList.add('disabled');
                    addCartBtn.innerHTML = '<i class="fa fa-shopping-bag me-2"></i>Hết hàng';
                    document.getElementById('stockStatus').innerText = 'Hết hàng';
                } else {
                    addCartBtn.disabled = false;
                    addCartBtn.classList.remove('disabled');
                    addCartBtn.innerHTML = '<i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ';
                    document.getElementById('stockStatus').innerText = 'Còn hàng - giao nhanh toàn quốc';
                }
            }
        });
    });

    document.querySelectorAll('.add-cart-btn').forEach(btn => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();

            let id = this.dataset.id;
            let variantId = this.dataset.variantId || '';
            let qty = document.getElementById('quantityInput')?.value || 1;

            let url = 'index.php?page=cart&action=add'
            + '&id=' + encodeURIComponent(id)
            + '&qty=' + encodeURIComponent(qty)
            + '&product_variant_id=' + encodeURIComponent(variantId);

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data && data.login_required) {
                        window.location.href = 'index.php?page=login';
                        return;
                    }

                    if (data.success) {
                        const t = document.createElement('div');
                        t.className = 'cart-toast';
                        t.innerText = '✓ Đã thêm sản phẩm vào giỏ hàng';
                        document.body.appendChild(t);
                        setTimeout(() => t.remove(), 2000);

                        const cartCountEl = document.querySelector('#cart-count');
                        if (cartCountEl) {
                            cartCountEl.innerText = data.count ?? (parseInt(cartCountEl.innerText || '0') + 1);
                        }
                    }
                });
        });
    });
});
</script>