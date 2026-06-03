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
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
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
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>