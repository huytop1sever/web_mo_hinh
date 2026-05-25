<?php

class CategoryController
{
    public function index()
    {
        $title = 'Quản lý danh mục';
        $pageTitle = 'Danh mục';

        $categories = [
            [
                'id' => 1,
                'name' => 'Gundam',
                'description' => 'Mô hình lắp ráp và phụ kiện Gundam',
                'product_count' => 42,
                'status' => 'Hiển thị',
            ],
            [
                'id' => 2,
                'name' => 'Anime Figure',
                'description' => 'Figure nhân vật anime và manga',
                'product_count' => 68,
                'status' => 'Hiển thị',
            ],
            [
                'id' => 3,
                'name' => 'Marvel',
                'description' => 'Mô hình siêu anh hùng Marvel',
                'product_count' => 21,
                'status' => 'Hiển thị',
            ],
            [
                'id' => 4,
                'name' => 'Pokemon',
                'description' => 'Mô hình và đồ sưu tầm Pokemon',
                'product_count' => 15,
                'status' => 'Tạm ẩn',
            ],
        ];

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/categories/index.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }
}
