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
                'image' => 'https://images.unsplash.com/photo-1633475794222-610e4ac29a04?auto=format&fit=crop&w=300&q=80',
                'name' => 'Mô hình Gundam RX-78-2',
                'category' => 'Gundam',
                'price' => 1250000,
                'stock' => 18,
                'status' => 'Đang bán',
            ],
            [
                'id' => 2,
                'image' => 'https://images.unsplash.com/photo-1618336753974-aae8e04506aa?auto=format&fit=crop&w=300&q=80',
                'name' => 'Figure Luffy Gear 5',
                'category' => 'Anime Figure',
                'price' => 890000,
                'stock' => 25,
                'status' => 'Đang bán',
            ],
            [
                'id' => 3,
                'image' => 'https://images.unsplash.com/photo-1608889825205-eebdb9fc5806?auto=format&fit=crop&w=300&q=80',
                'name' => 'Mô hình Iron Man Mark 85',
                'category' => 'Marvel',
                'price' => 1590000,
                'stock' => 9,
                'status' => 'Sắp hết',
            ],
            [
                'id' => 4,
                'image' => 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?auto=format&fit=crop&w=300&q=80',
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

        $product = [
            'id' => $id,
            'image' => 'https://images.unsplash.com/photo-1618336753974-aae8e04506aa?auto=format&fit=crop&w=300&q=80',
            'name' => 'Sản phẩm mẫu',
            'category' => 'Anime Figure',
            'price' => 100000,
            'stock' => 10,
            'status' => 'Đang bán',
        ];

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';
        include_once __DIR__ . '/../../Views/admin/products/edit.php';
        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    public function store()
{
    header('Location: index.php?page=products');
    exit;
}

public function update()
{
    header('Location: index.php?page=products');
    exit;
}

public function delete($id)
{
    header('Location: index.php?page=products');
    exit;
}
}