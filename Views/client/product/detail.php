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

$formatMoney = static function ($amount): string {
    return number_format((float) $amount, 0, ',', '.') . 'đ';
};

$imagePath = static function ($image) {
    if (empty($image)) {
        return '';
    }

    $path = (string) $image;

    if (!str_contains($path, 'uploads/') && !str_contains($path, 'assets/')) {
        $path = 'uploads/products/' . $path;
    }

    return $path;
};

$mainImage = $imagePath($product['image'] ?? '') ?: $fallbackImage;

$totalStock = 0;
$selectedVariant = null;

foreach ($variants as $variant) {
    $stock = (int) ($variant['stock'] ?? 0);
    $totalStock += $stock;

    if ($selectedVariant === null && $stock > 0) {
        $selectedVariant = $variant;
    }
}

if ($selectedVariant === null && !empty($variants)) {
    $selectedVariant = $variants[0];
}

if ($totalStock <= 0 && isset($product['total_stock'])) {
    $totalStock = (int) $product['total_stock'];
}

$basePrice = (float) ($product['price'] ?? 0);
$baseSalePrice = (float) ($product['sale_price'] ?? 0);

if ($selectedVariant) {
    $basePrice = (float) ($selectedVariant['price'] ?? 0);
    $baseSalePrice = (float) ($selectedVariant['sale_price'] ?? 0);
}

$currentPrice = $baseSalePrice > 0 ? $baseSalePrice : $basePrice;
$oldPrice = $baseSalePrice > 0 ? $basePrice : 0;
$selectedStock = $selectedVariant ? (int) ($selectedVariant['stock'] ?? 0) : $totalStock;
$selectedSku = $selectedVariant['sku'] ?? ($product['sku'] ?? 'PH-' . $product['id']);
$isOutOfStock = $selectedStock <= 0;
?>

<div id="toast"></div>

<main class="product-detail-page">
    <div class="container">
        <nav class="product-breadcrumb">
            <a href="index.php">Trang chủ</a>
            <span>/</span>
            <a href="index.php?page=product">Sản phẩm</a>
            <span>/</span>
            <strong><?= htmlspecialchars($product['name'] ?? '') ?></strong>
        </nav>

        <section class="product-detail">
            <div class="product-gallery">
                <div class="product-main-image">
                    <img
                        id="mainProductImage"
                        src="<?= htmlspecialchars($mainImage) ?>"
                        alt="<?= htmlspecialchars($product['name'] ?? '') ?>"
                        onerror="this.src='<?= htmlspecialchars($fallbackImage) ?>'">

                    <span><?= htmlspecialchars($product['category_name'] ?? 'Mô hình') ?></span>
                </div>

                <div class="product-thumbs">
                    <button type="button" class="active" onclick="changeMainImage(this)">
                        <img
                            src="<?= htmlspecialchars($mainImage) ?>"
                            alt="Ảnh chính"
                            onerror="this.src='<?= htmlspecialchars($fallbackImage) ?>'">
                    </button>

                    <?php foreach ($productImages as $img): ?>
                        <?php if (!empty($img['image'])): ?>
                            <?php $subImage = $imagePath($img['image']); ?>

                            <button type="button" onclick="changeMainImage(this)">
                                <img
                                    src="<?= htmlspecialchars($subImage) ?>"
                                    alt="Ảnh phụ"
                                    onerror="this.closest('button').remove()">
                            </button>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php foreach ($variants as $variant): ?>
                        <?php if (!empty($variant['image'])): ?>
                            <?php $variantImage = $imagePath($variant['image']); ?>

                            <button type="button" onclick="changeMainImage(this)">
                                <img
                                    src="<?= htmlspecialchars($variantImage) ?>"
                                    alt="Ảnh biến thể"
                                    onerror="this.closest('button').remove()">
                            </button>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="product-detail-info">
                <span id="detailStockStatus" class="detail-status <?= $isOutOfStock ? 'out-of-stock' : '' ?>">
                    <?= $isOutOfStock ? 'Hết hàng' : 'Còn hàng - giao nhanh toàn quốc' ?>
                </span>

                <h1><?= htmlspecialchars($product['name'] ?? '') ?></h1>

                <div class="detail-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span>4.8 | 126 đánh giá</span>
                </div>

                <div class="detail-price">
                    <strong id="detailPrice"><?= $formatMoney($currentPrice) ?></strong>
                    <del id="detailOldPrice" <?= $oldPrice > 0 ? '' : 'style="display:none;"' ?>>
                        <?= $oldPrice > 0 ? $formatMoney($oldPrice) : '' ?>
                    </del>
                </div>

                <p class="detail-desc">
                    <?= nl2br(htmlspecialchars($product['description'] ?? 'Đang cập nhật mô tả cho sản phẩm này.')) ?>
                </p>

                <?php if (!empty($variants)): ?>
                    <div class="detail-variants">
                        <div class="detail-variant-title">
                            <h6>Phiên bản</h6>
                            <span>Chọn 1 biến thể để cập nhật giá và tồn kho</span>
                        </div>

                        <div class="variant-options">
                            <?php foreach ($variants as $index => $variant): ?>
                                <?php
                                    $variantId = (string) ($variant['id'] ?? $index);
                                    $variantPrice = (float) ($variant['price'] ?? 0);
                                    $variantSalePrice = (float) ($variant['sale_price'] ?? 0);
                                    $variantCurrentPrice = $variantSalePrice > 0 ? $variantSalePrice : $variantPrice;
                                    $variantOldPrice = $variantSalePrice > 0 ? $variantPrice : 0;
                                    $variantStock = (int) ($variant['stock'] ?? 0);
                                    $variantImage = $imagePath($variant['image'] ?? '');
                                    $isActiveVariant = $selectedVariant && (string) ($selectedVariant['id'] ?? '') === (string) ($variant['id'] ?? '');
                                ?>

                                <button
                                    type="button"
                                    class="variant-option <?= $isActiveVariant ? 'active' : '' ?> <?= $variantStock <= 0 ? 'out-of-stock' : '' ?>"
                                    data-variant-id="<?= htmlspecialchars($variantId) ?>"
                                    data-name="<?= htmlspecialchars($variant['variant_name'] ?? '') ?>"
                                    data-price="<?= htmlspecialchars((string) $variantCurrentPrice) ?>"
                                    data-old-price="<?= htmlspecialchars((string) $variantOldPrice) ?>"
                                    data-stock="<?= htmlspecialchars((string) $variantStock) ?>"
                                    data-sku="<?= htmlspecialchars($variant['sku'] ?? '') ?>"
                                    data-image="<?= htmlspecialchars($variantImage) ?>">
                                    <strong><?= htmlspecialchars($variant['variant_name'] ?? 'Biến thể') ?></strong>
                                    <span><?= $formatMoney($variantCurrentPrice) ?></span>
                                    <small><?= $variantStock > 0 ? 'Còn ' . $variantStock : 'Hết hàng' ?></small>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="detail-actions">
                    <div class="detail-quantity">
                        <button type="button" data-qty-action="minus">-</button>
                        <input
                            id="productQuantity"
                            type="number"
                            value="1"
                            min="1"
                            max="<?= max(1, $selectedStock) ?>">
                        <button type="button" data-qty-action="plus">+</button>
                    </div>

                    <button
                        type="button"
                        id="detailAddCartBtn"
                        class="btn detail-cart-btn add-cart-btn <?= $isOutOfStock ? 'disabled' : '' ?>"
                        data-id="<?= htmlspecialchars((string) $product['id']) ?>"
                        data-variant-id="<?= htmlspecialchars((string) ($selectedVariant['id'] ?? '')) ?>"
                        <?= $isOutOfStock ? 'disabled' : '' ?>>
                        <i class="fa fa-shopping-bag me-2"></i>
                        <span><?= $isOutOfStock ? 'Hết hàng' : 'Thêm vào giỏ' ?></span>
                    </button>
                </div>

                <div class="detail-meta">
                    <div>
                        <span>Mã sản phẩm</span>
                        <strong id="detailSku"><?= htmlspecialchars($selectedSku) ?></strong>
                    </div>

                    <div>
                        <span>Tồn kho</span>
                        <strong id="detailStock"><?= htmlspecialchars((string) $selectedStock) ?></strong>
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
                    $rPrice = (float) (($item['sale_price'] ?? 0) > 0 ? $item['sale_price'] : ($item['price'] ?? 0));
                    $rImage = $imagePath($item['image'] ?? '') ?: $fallbackImage;
                    ?>

                    <div class="col-md-4">
                        <div class="related-card">
                            <img
                                src="<?= htmlspecialchars($rImage) ?>"
                                alt="<?= htmlspecialchars($item['name'] ?? '') ?>"
                                onerror="this.src='<?= htmlspecialchars($fallbackImage) ?>'">

                            <div>
                                <span><?= htmlspecialchars($item['category'] ?? 'Mô hình') ?></span>

                                <h4>
                                    <a href="index.php?page=product-detail&id=<?= htmlspecialchars((string) $item['id']) ?>">
                                        <?= htmlspecialchars($item['name'] ?? '') ?>
                                    </a>
                                </h4>

                                <strong><?= $formatMoney($rPrice) ?></strong>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>

<script>
function formatVnd(value) {
    return Number(value || 0).toLocaleString('vi-VN') + 'đ';
}

function showToast(message, type = 'success') {
    let toast = document.getElementById('toast');

    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast';
        document.body.appendChild(toast);
    }

    const item = document.createElement('div');
    item.className = 'toast-item toast-' + type;
    item.innerHTML = message;
    toast.appendChild(item);

    setTimeout(() => {
        item.remove();
    }, 3000);
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

document.addEventListener('DOMContentLoaded', function () {
    const priceEl = document.getElementById('detailPrice');
    const oldPriceEl = document.getElementById('detailOldPrice');
    const stockEl = document.getElementById('detailStock');
    const skuEl = document.getElementById('detailSku');
    const statusEl = document.getElementById('detailStockStatus');
    const qtyInput = document.getElementById('productQuantity');
    const addCartBtn = document.getElementById('detailAddCartBtn');
    const mainImage = document.getElementById('mainProductImage');

    function updateCartButton(stock) {
        const text = addCartBtn ? addCartBtn.querySelector('span') : null;

        if (!addCartBtn || !text) return;

        if (stock <= 0) {
            addCartBtn.disabled = true;
            addCartBtn.classList.add('disabled');
            text.textContent = 'Hết hàng';
        } else {
            addCartBtn.disabled = false;
            addCartBtn.classList.remove('disabled');
            text.textContent = 'Thêm vào giỏ';
        }
    }

    document.querySelectorAll('.variant-option').forEach(button => {
        button.addEventListener('click', function () {
            const price = Number(this.dataset.price || 0);
            const oldPrice = Number(this.dataset.oldPrice || 0);
            const stock = Number(this.dataset.stock || 0);
            const sku = this.dataset.sku || '';
            const image = this.dataset.image || '';

            document.querySelectorAll('.variant-option').forEach(item => {
                item.classList.remove('active');
            });

            this.classList.add('active');

            if (priceEl) {
                priceEl.textContent = formatVnd(price);
            }

            if (oldPriceEl) {
                if (oldPrice > 0) {
                    oldPriceEl.textContent = formatVnd(oldPrice);
                    oldPriceEl.style.display = '';
                } else {
                    oldPriceEl.textContent = '';
                    oldPriceEl.style.display = 'none';
                }
            }

            if (stockEl) {
                stockEl.textContent = stock;
            }

            if (skuEl) {
                skuEl.textContent = sku || 'PH-' + (addCartBtn ? addCartBtn.dataset.id : '');
            }

            if (statusEl) {
                statusEl.textContent = stock > 0 ? 'Còn hàng - giao nhanh toàn quốc' : 'Hết hàng';
                statusEl.classList.toggle('out-of-stock', stock <= 0);
            }

            if (qtyInput) {
                qtyInput.max = Math.max(1, stock);
                qtyInput.value = stock > 0 ? 1 : 1;
            }

            if (addCartBtn) {
                addCartBtn.dataset.variantId = this.dataset.variantId || '';
            }

            if (image && mainImage) {
                mainImage.src = image;
            }

            updateCartButton(stock);
        });
    });

    document.querySelectorAll('.detail-quantity button').forEach(button => {
        button.addEventListener('click', function () {
            if (!qtyInput) return;

            const max = Number(qtyInput.max || 9999);
            let value = Number(qtyInput.value || 1);

            if (this.dataset.qtyAction === 'plus') {
                value = Math.min(max, value + 1);
            } else {
                value = Math.max(1, value - 1);
            }

            qtyInput.value = value;
        });
    });

    if (qtyInput) {
        qtyInput.addEventListener('input', function () {
            const max = Number(this.max || 9999);
            let value = Number(this.value || 1);

            if (value < 1) value = 1;
            if (value > max) value = max;

            this.value = value;
        });
    }

    if (addCartBtn) {
        addCartBtn.addEventListener('click', function (event) {
            event.preventDefault();

            if (this.disabled) {
                showToast('Sản phẩm đang hết hàng', 'error');
                return;
            }

            const params = new URLSearchParams({
                page: 'cart',
                action: 'add',
                id: this.dataset.id,
                qty: qtyInput ? qtyInput.value : '1'
            });

            if (this.dataset.variantId) {
                params.set('variant_id', this.dataset.variantId);
            }

            fetch('index.php?' + params.toString())
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showToast('✓ Đã thêm sản phẩm vào giỏ hàng', 'success');
                    } else {
                        showToast('✕ ' + (data.message || 'Thêm vào giỏ hàng thất bại'), 'error');
                    }
                })
                .catch(() => {
                    showToast('✕ Thêm vào giỏ hàng thất bại', 'error');
                });
        });
    }
});
</script>
