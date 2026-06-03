<?php $products = $products ?? []; ?>

<div class="box">
    <div class="box-title">
        <h2>Danh sách sản phẩm</h2>

        <a href="index.php?page=product-add" class="btn-primary">
            <i class='bx bx-plus'></i>
            <span>Thêm sản phẩm</span>
        </a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Mô tả</th>
                    <th>Giá từ</th>
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td>#<?= $product['id'] ?></td>

                        <td class="product-name">
                            <?= htmlspecialchars($product['name']) ?>
                        </td>

                        <td>
                            <img src="<?= htmlspecialchars($product['image']) ?>"
                                 alt="<?= htmlspecialchars($product['name']) ?>"
                                 class="product-thumb">
                        </td>

                        <td><?= htmlspecialchars($product['category']) ?></td>

                        <td class="product-description">
                            <?= mb_strimwidth($product['description'], 0, 80, '...') ?>
                        </td>

                        <td><?= number_format($product['price'], 0, ',', '.') ?>đ</td>

                        <td><?= $product['stock'] ?></td>

                        <td>
                            <span class="status <?= $product['status'] === 'Hết hàng'
                                ? 'cancelled'
                                : ($product['status'] === 'Sắp hết' ? 'pending' : 'confirmed') ?>">
                                <?= $product['status'] ?>
                            </span>
                        </td>

                        <td>
                            <div class="table-actions">
                                <a href="index.php?page=product-edit&id=<?= $product['id'] ?>"
                                   class="action-btn edit">
                                    <i class='bx bx-edit'></i>
                                </a>

                                <a href="index.php?page=product-delete&id=<?= $product['id'] ?>"
                                   class="action-btn delete"
                                   onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="9" style="text-align:center;">Chưa có sản phẩm nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>