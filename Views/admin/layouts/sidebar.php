<aside class="sidebar">

    <div class="logo">
        <i class='bx bxs-store'></i>
        <span>Phantom</span>
    </div>

    <?php
    $currentPage = $_GET['act'] ?? $_GET['page'] ?? 'dashboard';
    $isCategoryPage = in_array($currentPage, ['categories', 'category-add', 'category-edit', 'category-store', 'category-update']);
    $isProductPage = in_array($currentPage, ['products', 'product-add', 'product-edit', 'product-store', 'product-update']);
    ?>

    <ul class="menu">

        <li>
            <a href="index.php?page=dashboard" class="<?= $currentPage === 'dashboard' ? 'active' : '' ?>">
                <i class='bx bxs-dashboard'></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="index.php?page=categories" class="<?= $isCategoryPage ? 'active' : '' ?>">
                <i class='bx bxs-category'></i>
                <span>Danh mục</span>
            </a>
        </li>

        <li>
            <a href="index.php?page=products" class="<?= $isProductPage ? 'active' : '' ?>">
                <i class='bx bxs-box'></i>
                <span>Sản phẩm</span>
            </a>
        </li>

        <li>
            <a href="index.php?page=users" class="<?= $currentPage === 'users' ? 'active' : '' ?>">
                <i class='bx bxs-user'></i>
                <span>Người dùng</span>
            </a>
        </li>

        <li>
            <a href="index.php?page=orders" class="<?= $currentPage === 'orders' ? 'active' : '' ?>">
                <i class='bx bxs-cart'></i>
                <span>Đơn hàng</span>
            </a>
        </li>

    </ul>

</aside>
