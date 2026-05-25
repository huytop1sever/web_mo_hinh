<?php

$products = $products ?? [];

?>

<div class="box">
    <div class="box-title">
        <h2>Danh sach san pham</h2>

        <a href="index.php?act=product-add" class="btn-primary">
            <i class='bx bx-plus'></i>
            <span>Them san pham</span>
        </a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ten san pham</th>
                    <th>Danh muc</th>
                    <th>Gia</th>
                    <th>Ton kho</th>
                    <th>Trang thai</th>
                    <th>Thao tac</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td>#<?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['category'] ?></td>
                        <td><?= number_format($product['price'], 0, ',', '.') ?>d</td>
                        <td><?= $product['stock'] ?></td>
                        <td>
                            <span class="status <?= $product['status'] === 'Het hang' || $product['status'] === 'Hết hàng' ? 'cancelled' : ($product['status'] === 'Sap het' || $product['status'] === 'Sắp hết' ? 'pending' : 'confirmed') ?>">
                                <?= $product['status'] ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="index.php?act=product-edit&id=<?= $product['id'] ?>" class="action-btn edit" title="Sua">
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
