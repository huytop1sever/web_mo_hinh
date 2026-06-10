<?php
$products = $products ?? [];
$categories = $categories ?? [];

$keyword = $_GET['keyword'] ?? '';
$categoryId = $_GET['category_id'] ?? '';

$currentPage = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$totalPages = isset($totalPages) ? (int)$totalPages : 1;
$limit = 10;

if ($currentPage < 1) {
    $currentPage = 1;
}

if ($totalPages < 1) {
    $totalPages = 1;
}

$stt = (($currentPage - 1) * $limit) + 1;
?>

<div class="box">

    <div class="box-title">
        <h2>Danh sách sản phẩm</h2>

        <a href="index.php?page=product-add" class="btn-primary">
            <i class='bx bx-plus'></i>
            <span>Thêm sản phẩm</span>
        </a>
    </div>

    <form method="get" action="index.php" class="product-search-form">
        <input type="hidden" name="page" value="products">

        <input
            type="text"
            name="keyword"
            placeholder="Tìm kiếm tên sản phẩm..."
            value="<?= htmlspecialchars($keyword) ?>">

        <select name="category_id">
            <option value="">Tất cả danh mục</option>

            <?php foreach ($categories as $category): ?>
                <option
                    value="<?= htmlspecialchars($category['id']) ?>"
                    <?= $categoryId == $category['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn-primary">
            <i class='bx bx-search'></i>
            Tìm kiếm
        </button>

        <a href="index.php?page=products" class="btn-reset">
            Làm mới
        </a>
    </form>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Biến thể</th>
                    <th>Trạng thái</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $stt++ ?></td>

                            <td>
                                <?php if (!empty($product['image'])): ?>
                                    <img
                                        src="../<?= htmlspecialchars($product['image']) ?>"
                                        alt="<?= htmlspecialchars($product['name']) ?>"
                                        class="product-thumb">
                                <?php else: ?>
                                    Không có ảnh
                                <?php endif; ?>
                            </td>

                            <td><?= htmlspecialchars($product['name']) ?></td>

                            <td><?= htmlspecialchars($product['category'] ?? '') ?></td>

                            <td>
                                <?php if (!empty($product['sale_price']) && $product['sale_price'] > 0): ?>
                                    <div class="product-price">
                                        <del><?= number_format($product['price'], 0, ',', '.') ?>đ</del>
                                        <strong><?= number_format($product['sale_price'], 0, ',', '.') ?>đ</strong>
                                    </div>
                                <?php elseif (!empty($product['price'])): ?>
                                    <strong><?= number_format($product['price'], 0, ',', '.') ?>đ</strong>
                                <?php else: ?>
                                    <span>Chưa có giá</span>
                                <?php endif; ?>
                            </td>

                            <td><?= htmlspecialchars($product['total_stock'] ?? 0) ?></td>

                            <td>
                                <span class="variant-count">
                                    <?= htmlspecialchars($product['variant_count'] ?? 0) ?> biến thể
                                </span>
                            </td>

                            <td>
                                <?php if (($product['variant_count'] ?? 0) == 0): ?>
                                    <span class="status no-variant">Chưa có biến thể</span>
                                <?php elseif (($product['total_stock'] ?? 0) <= 0): ?>
                                    <span class="status out-stock">Hết hàng</span>
                                <?php elseif (($product['product_status'] ?? 1) == 1): ?>
                                    <span class="status active">Đang bán</span>
                                <?php else: ?>
                                    <span class="status hidden">Đang ẩn</span>
                                <?php endif; ?>
                            </td>

                            <td class="product-description">
                                <?= mb_strimwidth(
                                    htmlspecialchars($product['description'] ?? ''),
                                    0,
                                    80,
                                    '...'
                                ) ?>
                            </td>

                            <td>
                                <?php if (!empty($product['created_at'])): ?>
                                    <?= date('d/m/Y', strtotime($product['created_at'])) ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="table-actions">
                                    <a
                                        href="index.php?page=product-edit&id=<?= htmlspecialchars($product['id']) ?>"
                                        class="action-btn edit">
                                        <i class='bx bx-edit'></i>
                                    </a>

                                    <a
                                        href="index.php?page=product-delete&id=<?= htmlspecialchars($product['id']) ?>"
                                        class="action-btn delete"
                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="11" style="text-align:center;">
                            Không tìm thấy sản phẩm nào
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
        <div class="pagination">

            <?php if ($currentPage > 1): ?>
                <a href="index.php?page=products&p=<?= $currentPage - 1 ?>&keyword=<?= urlencode($keyword) ?>&category_id=<?= urlencode($categoryId) ?>">
                    Trước
                </a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="index.php?page=products&p=<?= $i ?>&keyword=<?= urlencode($keyword) ?>&category_id=<?= urlencode($categoryId) ?>"
                   class="<?= $i === $currentPage ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="index.php?page=products&p=<?= $currentPage + 1 ?>&keyword=<?= urlencode($keyword) ?>&category_id=<?= urlencode($categoryId) ?>">
                    Sau
                </a>
            <?php endif; ?>

        </div>
    <?php endif; ?>

</div>