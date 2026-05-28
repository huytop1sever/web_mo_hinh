<?php require_once 'Views/client/layouts/header.php'; ?>

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
                        <label><input type="checkbox"> Dưới 1.000.000đ</label>
                        <label><input type="checkbox"> 1.000.000đ - 2.000.000đ</label>
                        <label><input type="checkbox"> Trên 2.000.000đ</label>
                    </div>

                    <div class="product-promo">
                        <span>Ưu đãi</span>
                        <h5>Giảm 15% cho đơn mô hình từ 2 sản phẩm</h5>
                        <p>Áp dụng cho figure có sẵn trong kho.</p>
                    </div>

                </aside>
            </div>

            <div class="col-lg-9">

                <?php
                $products = [
                    ['id'=>1,'img'=>'luffy-gear-5.jpg','tag'=>'One Piece','name'=>'Luffy Gear 5 Figure','price'=>'2.500.000đ','status'=>'Còn hàng'],
                    ['id'=>2,'img'=>'fruite-item-2.jpg','tag'=>'Naruto','name'=>'Naruto Uzumaki Sage Mode','price'=>'1.850.000đ','status'=>'Còn hàng'],
                    ['id'=>3,'img'=>'fruite-item-3.webp','tag'=>'Dragon Ball','name'=>'Son Goku Ultra Instinct','price'=>'2.200.000đ','status'=>'Bán chạy'],
                    ['id'=>4,'img'=>'fruite-item-4.webp','tag'=>'Demon Slayer','name'=>'Tanjiro Kamado Figure','price'=>'1.650.000đ','status'=>'Còn hàng'],
                    ['id'=>5,'img'=>'fruite-item-5.webp','tag'=>'Jujutsu Kaisen','name'=>'Gojo Satoru Premium','price'=>'2.900.000đ','status'=>'Hot'],
                    ['id'=>6,'img'=>'fruite-item-6.webp','tag'=>'Attack On Titan','name'=>'Levi Ackerman Figure','price'=>'2.750.000đ','status'=>'Còn hàng'],
                    ['id'=>7,'img'=>'best-product-1.jpg','tag'=>'Nendoroid','name'=>'Nendoroid Anime Collection','price'=>'950.000đ','status'=>'Giá tốt'],
                    ['id'=>8,'img'=>'best-product-2.jpg','tag'=>'Gundam','name'=>'Gundam Assembly Model','price'=>'1.450.000đ','status'=>'Mới về'],
                    ['id'=>9,'img'=>'best-product-3.webp','tag'=>'Marvel','name'=>'Hero Action Figure','price'=>'1.990.000đ','status'=>'Còn hàng'],
                ];

                $limit = 6;
                $pageNow = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;
                $totalPages = ceil(count($products) / $limit);
                $start = ($pageNow - 1) * $limit;
                $productsPage = array_slice($products, $start, $limit);
                ?>

                <div class="row g-4">
                    <?php foreach ($productsPage as $product) { ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="product-card">

                                <div class="product-img">
                                    <img src="assets/client/img/<?php echo $product['img']; ?>" alt="">
                                    <span><?php echo $product['tag']; ?></span>
                                </div>

                                <div class="product-content">

                                    <div class="product-top">
                                        <b><?php echo $product['status']; ?></b>
                                        <div>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                    </div>

                                    <h4><?php echo $product['name']; ?></h4>

                                    <p>Mô hình chi tiết sắc nét, phù hợp trưng bày bàn làm việc và bộ sưu tập cá nhân.</p>

                                    <h3><?php echo $product['price']; ?></h3>

                                    <div class="product-actions">
                                        <button
                                            type="button"
                                            class="add-cart-btn"
                                            data-id="<?php echo $product['id']; ?>">
                                            <i class="fa fa-shopping-bag"></i>
                                            Thêm vào giỏ
                                        </button>

                                        <a href="index.php?page=product-detail&id=<?php echo $product['id']; ?>">
                                            <i class="fa fa-eye"></i>
                                            Chi tiết
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    <?php } ?>
                </div>

                <ul class="product-pagination">
                    <li class="<?php echo ($pageNow <= 1) ? 'disabled' : ''; ?>">
                        <a href="index.php?page=products&p=<?php echo $pageNow - 1; ?>">Trước</a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <li class="<?php echo ($pageNow == $i) ? 'active' : ''; ?>">
                            <a href="index.php?page=products&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>

                    <li class="<?php echo ($pageNow >= $totalPages) ? 'disabled' : ''; ?>">
                        <a href="index.php?page=products&p=<?php echo $pageNow + 1; ?>">Sau</a>
                    </li>
                </ul>

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