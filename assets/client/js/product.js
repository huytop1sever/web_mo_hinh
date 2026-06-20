function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');

    if (!toast) return;

    const item = document.createElement('div');
    item.className = 'toast-item toast-' + type;
    item.innerHTML = message;

    toast.appendChild(item);

    setTimeout(() => {
        item.remove();
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function () {

    const filterForm = document.querySelector('.product-filter');
    const sortSelect = document.querySelector('select[name="sort"]');
    const priceRangeSelect = document.querySelector('select[name="price_range"]');

    if (sortSelect && filterForm) {
        sortSelect.addEventListener('change', function () {
            filterForm.submit();
        });
    }

    if (priceRangeSelect && filterForm) {
        priceRangeSelect.addEventListener('change', function () {
            filterForm.submit();
        });
    }

    document.querySelectorAll('.add-cart-btn').forEach(btn => {

        btn.addEventListener('click', function (event) {

            event.preventDefault();
            event.stopPropagation();

            if (this.disabled) return;

            const id = this.dataset.id;

            fetch(
                'index.php?page=cart&action=add&id=' +
                encodeURIComponent(id)
            )
            .then(res => res.json())
            .then(data => {

                if (data && data.login_required) {
                    window.location.href = 'index.php?page=login';
                    return;
                }

                if (data && data.success) {

                    showToast(
                        '✓ Đã thêm sản phẩm vào giỏ hàng',
                        'success'
                    );

                    const cartCountEl =
                        document.querySelector('#cart-count');

                    if (cartCountEl) {

                        cartCountEl.innerText =
                            typeof data.count !== 'undefined'
                                ? data.count
                                : parseInt(cartCountEl.innerText || '0') + 1;
                    }

                } else {

                    showToast(
                        '✕ Thêm vào giỏ hàng thất bại',
                        'error'
                    );

                }

            })
            .catch(() => {

                showToast(
                    '✕ Thêm vào giỏ hàng thất bại',
                    'error'
                );

            });

        });

    });

});