<?php
require_once 'Models/Cart.php';
require_once 'Models/Product.php';

$cartModel = new Cart();
$cartItems = $cartModel->getItems();

$subtotal = 0;
?>

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Giỏ hàng</h1>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">

        <div id="cart-alert"></div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Tên</th>
                        <th>Biến thể</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($cartItems)): ?>
                        <?php foreach ($cartItems as $item): ?>
                            <?php
                            $productId = (int)($item['product_id'] ?? 0);
                            $variantId = $item['product_variant_id'] ?? null;
                            $qty = (int)($item['qty'] ?? 0);

                            if ($qty <= 0) {
                                continue;
                            }

                            $price = !empty($item['sale_price']) && $item['sale_price'] > 0
                                ? (float)$item['sale_price']
                                : (float)($item['price'] ?? 0);

                            $lineTotal = $price * $qty;
                            $subtotal += $lineTotal;
                            ?>

                            <tr class="cart-item"
                                data-id="<?= $productId ?>"
                                data-variant-id="<?= htmlspecialchars((string)$variantId) ?>">

                                <td>
                                    <img src="<?= htmlspecialchars($item['product_image'] ?? $item['image'] ?? 'assets/client/img/no-image.png') ?>"
                                         class="img-fluid rounded"
                                         style="width:90px;height:90px;object-fit:cover;">
                                </td>

                                <td>
                                    <p class="mb-0">
                                        <?= htmlspecialchars($item['product_name'] ?? $item['title'] ?? $item['name'] ?? '') ?>
                                    </p>
                                </td>

                                <td>
                                    <p class="mb-0">
                                        <?= htmlspecialchars($item['variant_name'] ?? 'Không có') ?>
                                    </p>
                                </td>

                                <td>
                                    <p class="mb-0 item-price" data-price="<?= (int)$price ?>">
                                        <?= number_format($price, 0, ',', '.') ?>đ
                                    </p>
                                </td>

                                <td>
                                    <div class="input-group quantity" style="width:120px;">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>

                                        <input type="text"
                                               class="form-control form-control-sm text-center border-0 quantity-input"
                                               value="<?= $qty ?>"
                                               readonly
                                               data-id="<?= $productId ?>"
                                               data-variant-id="<?= htmlspecialchars((string)$variantId) ?>">

                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </td>

                                <td>
                                    <p class="mb-0 item-total">
                                        <?= number_format($lineTotal, 0, ',', '.') ?>đ
                                    </p>
                                </td>

                                <td>
                                    <button type="button"
                                            class="btn btn-md rounded-circle bg-light border remove-item"
                                            data-id="<?= $productId ?>"
                                            data-variant-id="<?= htmlspecialchars((string)$variantId) ?>">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fa fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <p class="mb-0">Giỏ hàng của bạn đang trống.</p>
                                <a href="index.php?page=product" class="btn btn-primary mt-2">Xem sản phẩm</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="row g-4 justify-content-end mt-4">
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Tổng giỏ hàng</h1>

                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0">Tạm tính:</h5>
                            <p class="mb-0" id="subtotal"><?= number_format($subtotal, 0, ',', '.') ?>đ</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0">Phí vận chuyển:</h5>
                            <p class="mb-0">Miễn phí</p>
                        </div>
                    </div>

                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4">Tổng cộng</h5>
                        <p class="mb-0 pe-4 fw-bold" id="grand-total"><?= number_format($subtotal, 0, ',', '.') ?>đ</p>
                    </div>

                    <a href="index.php?page=checkout"
                       class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">
                        Tiến hành thanh toán
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
#cart-alert {
    position: fixed;
    top: 30px;
    right: 30px;
    z-index: 99999;
}

.cart-toast {
    min-width: 300px;
    padding: 15px 20px;
    margin-bottom: 10px;
    border-radius: 8px;
    color: #fff;
    font-weight: 600;
    background: #28a745;
    animation: slideIn .3s ease;
}

.cart-toast.error {
    background: #dc3545;
}

.quantity {
    display: flex;
    align-items: center;
    gap: 6px;
}

.quantity-input {
    width: 40px !important;
    background: transparent !important;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(100%);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>

<script>
function formatMoney(number) {
    return number.toLocaleString('vi-VN') + 'đ';
}

function updateCartTotal() {
    let total = 0;

    document.querySelectorAll('.cart-item').forEach(function(row) {
        let price = parseInt(row.querySelector('.item-price').dataset.price);
        let quantity = parseInt(row.querySelector('.quantity-input').value);
        let itemTotal = price * quantity;

        row.querySelector('.item-total').innerText = formatMoney(itemTotal);
        total += itemTotal;
    });

    document.getElementById('subtotal').innerText = formatMoney(total);
    document.getElementById('grand-total').innerText = formatMoney(total);
}

function showCartToast(message, type = 'success') {
    const box = document.getElementById('cart-alert');

    const item = document.createElement('div');
    item.className = type === 'success' ? 'cart-toast' : 'cart-toast error';
    item.innerHTML = message;

    box.appendChild(item);

    setTimeout(function() {
        item.remove();
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cart-item').forEach(function(row) {
        const minus = row.querySelector('.btn-minus');
        const plus = row.querySelector('.btn-plus');
        const input = row.querySelector('.quantity-input');

        function updateQty(newQty) {
            fetch('index.php?page=cart&action=update', {
                method: 'POST',
                body: new URLSearchParams({
                    id: input.dataset.id,
                    product_variant_id: input.dataset.variantId,
                    qty: newQty
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    input.value = newQty;
                    updateCartTotal();
                } else {
                    showCartToast('✕ Cập nhật thất bại', 'error');
                }
            })
            .catch(() => showCartToast('✕ Cập nhật thất bại', 'error'));
        }

        minus.addEventListener('click', function() {
            let qty = parseInt(input.value);

            if (qty > 1) {
                updateQty(qty - 1);
            }
        });

        plus.addEventListener('click', function() {
            let qty = parseInt(input.value);
            updateQty(qty + 1);
        });
    });

    document.querySelectorAll('.remove-item').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const variantId = this.dataset.variantId;
            const row = this.closest('.cart-item');

            fetch(
                'index.php?page=cart&action=remove&id=' + encodeURIComponent(id)
                + '&product_variant_id=' + encodeURIComponent(variantId)
            )
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    row.remove();
                    updateCartTotal();
                    showCartToast('✓ Đã xóa sản phẩm khỏi giỏ hàng', 'success');

                    if (document.querySelectorAll('.cart-item').length === 0) {
                        location.reload();
                    }
                } else {
                    showCartToast('✕ Xóa thất bại', 'error');
                }
            })
            .catch(() => showCartToast('✕ Xóa thất bại', 'error'));
        });
    });

    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get('status') === 'success') {
        showCartToast('✓ Đã thêm sản phẩm vào giỏ hàng', 'success');
    }

    if (urlParams.get('status') === 'error') {
        showCartToast('✕ Thêm vào giỏ hàng thất bại', 'error');
    }

    updateCartTotal();
});
</script>