<?php

$categories = $categories ?? [
    [
        'id' => 1,
        'name' => 'Gundam',
        'description' => 'Mo hinh lap rap va phu kien Gundam',
        'product_count' => 42,
        'status' => 'Hien thi',
    ],
    [
        'id' => 2,
        'name' => 'Anime Figure',
        'description' => 'Figure nhan vat anime va manga',
        'product_count' => 68,
        'status' => 'Hien thi',
    ],
    [
        'id' => 3,
        'name' => 'Marvel',
        'description' => 'Mo hinh sieu anh hung Marvel',
        'product_count' => 21,
        'status' => 'Hien thi',
    ],
    [
        'id' => 4,
        'name' => 'Pokemon',
        'description' => 'Mo hinh va do suu tam Pokemon',
        'product_count' => 15,
        'status' => 'Tam an',
    ],
];

?>

<div class="box">

    <div class="box-title">
        <h2>Danh sach danh muc</h2>

        <a href="#" class="btn-primary">
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

                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td>#<?= $category['id'] ?></td>
                        <td><?= $category['name'] ?></td>
                        <td><?= $category['description'] ?></td>
                        <td><?= $category['product_count'] ?></td>
                        <td>
                            <span class="status <?= $category['status'] === 'Tam an' ? 'pending' : 'confirmed' ?>">
                                <?= $category['status'] ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="#" class="action-btn edit" title="Sua">
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
