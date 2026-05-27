<?php

class ProductController
{
    public function index()
    {
        $title = 'Quản lý sản phẩm';
        $pageTitle = 'Sản phẩm';

        $products = [
            [
                'id' => 1,
                'name' => 'Mô hình Gundam RX-78-2',
                'category' => 'Gundam',
                'price' => 1250000,
                'stock' => 18,
                'status' => 'Đang bán',
            ],
            [
                'id' => 2,
                'name' => 'Figure Luffy Gear 5',
                'category' => 'Anime Figure',
                'price' => 890000,
                'stock' => 25,
                'status' => 'Đang bán',
            ],
            [
                'id' => 3,
                'name' => 'Mô hình Iron Man Mark 85',
                'category' => 'Marvel',
                'price' => 1590000,
                'stock' => 9,
                'status' => 'Sắp hết',
            ],
            [
                'id' => 4,
                'name' => 'Pokemon Pikachu PVC',
                'category' => 'Pokemon',
                'price' => 320000,
                'stock' => 0,
                'status' => 'Hết hàng',
            ],
        ];

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/products/index.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    public function add()
    {
        $title = 'Thêm sản phẩm mới';
        $pageTitle = 'Sản phẩm';

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';
        include_once __DIR__ . '/../../Views/admin/products/add.php';
        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    public function edit($id)
    {
        $title = 'Chỉnh sửa sản phẩm';
        $pageTitle = 'Sửa sản phẩm';

        // Giả lập dữ liệu
        $product = ['id' => $id, 'name' => 'Sản phẩm mẫu', 'price' => 100000, 'stock' => 10, 'status' => 'Đang bán'];

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';
        include_once __DIR__ . '/../../Views/admin/products/edit.php';
        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    public function store()
    {
        header('Location: index.php?act=products');
    }

    public function update()
    {
        header('Location: index.php?act=products');
    }

    public function delete($id)
    {
        header('Location: index.php?act=products');
    }
}
