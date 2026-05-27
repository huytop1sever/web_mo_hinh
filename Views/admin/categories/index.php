<div class="box">
    <div class="box-title">
        <h2>Danh sach danh muc</h2>
        <a href="index.php?act=category-add" class="btn-primary">
            <i class='bx bx-plus'></i>
            <span>Them danh muc</span>
        </a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ten danh muc</th>
                    <th>Mo ta</th>
                    <th>So san pham</th>
                    <th>Trang thai</th>
                    <th>Thao tac</th>
                </tr>
            </thead>
            <tbody>
                <?php $categories = $categories ?? []; ?>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td>#<?= $category['id'] ?></td>
                        <td><strong><?= $category['name'] ?></strong></td>
                        <td><?= $category['description'] ?></td>
                        <td><?= $category['product_count'] ?></td>
                        <td>
                            <span class="status <?= $category['status'] === 'Hien thi' || $category['status'] === 'Hiển thị' ? 'confirmed' : 'cancelled' ?>">
                                <?= $category['status'] ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="index.php?act=category-edit&id=<?= $category['id'] ?>" class="action-btn edit" title="Sua">
                                    <i class='bx bx-edit'></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
