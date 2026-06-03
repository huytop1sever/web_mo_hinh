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
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Mô tả</th>
<<<<<<< HEAD
<<<<<<< HEAD
                    <th>Giá từ</th>
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
=======
                    <th>Ngày tạo</th>
>>>>>>> 1d421b2 (adminSanPham)
                    <th>Thao tác</th>
=======
                    <th class="product-price-col">Giá</th>
                    <th class="product-stock-col">Tồn kho</th>
                    <th class="product-status-col">Trạng thái</th>
                    <th class="product-action-col">Thao tác</th>
>>>>>>> db531e74fedf0048d3cf07ab08e028f6e8dddbae
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>#<?= $product['id'] ?></td>

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

                            <td class="product-name">
                                <?= htmlspecialchars($product['name']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($product['category'] ?? '') ?>
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
                                        href="index.php?page=product-edit&id=<?= $product['id'] ?>"
                                        class="action-btn edit">
                                        <i class='bx bx-edit'></i>
                                    </a>

                                    <a
                                        href="index.php?page=product-delete&id=<?= $product['id'] ?>"
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
                        <td colspan="7" style="text-align:center;">
                            Chưa có sản phẩm nào
                        </td>
<<<<<<< HEAD

                        <td>
                            <img src="<?= htmlspecialchars($product['image']) ?>"
                                 alt="<?= htmlspecialchars($product['name']) ?>"
                                 class="product-thumb">
                        </td>

                        <td><?= htmlspecialchars($product['category']) ?></td>

                        <td class="product-description">
                            <?= mb_strimwidth($product['description'], 0, 80, '...') ?>
                        </td>

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
<<<<<<< HEAD
                        <td colspan="9" style="text-align:center;">Chưa có sản phẩm nào</td>
=======
                        <td colspan="9" style="text-align: center;">
                            Chưa có sản phẩm nào
                        </td>
>>>>>>> db531e74fedf0048d3cf07ab08e028f6e8dddbae
=======
>>>>>>> 1d421b2 (adminSanPham)
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>