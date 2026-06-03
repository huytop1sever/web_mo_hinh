<?php

require_once '../Models/Product.php';

class ProductController
{
    public function index()
    {
        $title = 'Quản lý sản phẩm';
        $pageTitle = 'Danh sách sản phẩm';

        $productModel = new Product();
        $products = $productModel->getAll();

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';

        include_once '../Views/admin/products/index.php';

        include_once '../Views/admin/layouts/footer.php';
    }

    public function add()
    {
        $title = 'Thêm sản phẩm';
        $pageTitle = 'Thêm sản phẩm';

        $productModel = new Product();
        $categories = $productModel->getCategories();

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';

        include_once '../Views/admin/products/add.php';

        include_once '../Views/admin/layouts/footer.php';
    }

    public function store()
    {
        $productModel = new Product();

        $image = '';

        if (!empty($_FILES['image']['name'])) {
            $image = $this->uploadImage();
        }

        $_POST['image'] = $image;

        $productModel->create($_POST);

        header('Location: index.php?page=products');
        exit;
    }

    public function edit($id)
    {
        $title = 'Sửa sản phẩm';
        $pageTitle = 'Sửa sản phẩm';

        $productModel = new Product();
        $product = $productModel->find($id);
        $categories = $productModel->getCategories();

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';

        include_once '../Views/admin/products/edit.php';

        include_once '../Views/admin/layouts/footer.php';
    }

    public function update()
    {
        $productModel = new Product();

        $oldProduct = $productModel->find($_POST['id']);

        $_POST['image'] = $oldProduct['image'] ?? '';

        if (!empty($_FILES['image']['name'])) {
            $_POST['image'] = $this->uploadImage();
        }

        $productModel->update($_POST);

        header('Location: index.php?page=products');
        exit;
    }

    public function delete($id)
    {
        $productModel = new Product();
        $productModel->delete($id);

        header('Location: index.php?page=products');
        exit;
    }

    private function uploadImage()
    {
        $uploadDir = '../uploads/products/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;

        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);

        return 'uploads/products/' . $fileName;
    }
}