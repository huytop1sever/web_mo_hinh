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

    public function add()
    {
        $title = 'Thêm danh mục mới';
        $pageTitle = 'Thêm danh mục';

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/categories/add.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    public function edit($id)
    {
        $title = 'Chỉnh sửa danh mục';
        $pageTitle = 'Sửa danh mục';

        // Giả lập lấy dữ liệu danh mục theo ID
        $category = [
            'id' => $id,
            'name' => 'Gundam',
            'description' => 'Mô hình lắp ráp và phụ kiện Gundam',
            'status' => 'Hiển thị'
        ];

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/categories/edit.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    public function store()
    {
        // Logic xử lý lưu dữ liệu từ form Thêm vào DB
        // Sau khi lưu xong, chuyển hướng về trang danh sách
        header('Location: index.php?act=categories');
    }

    public function update()
    {
        // Logic xử lý cập nhật dữ liệu từ form Sửa vào DB
        // Sau khi cập nhật xong, chuyển hướng về trang danh sách
        header('Location: index.php?act=categories');
    }

    public function delete($id)
    {
        // Logic xóa danh mục thực tế (ví dụ: DELETE FROM categories WHERE id = $id)
        // Sau khi xóa, chuyển hướng về trang danh sách
        header('Location: index.php?act=categories');
    }
}
