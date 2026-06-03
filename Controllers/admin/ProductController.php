<?php

require_once __DIR__ . '/../../Models/Product.php';

class ProductController
{
    private function render($view, $data = [])
    {
        extract($data);

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . "/../../Views/admin/products/$view.php";

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    public function index()
    {
        $title = 'Quản lý sản phẩm';
        $pageTitle = 'Sản phẩm';

        $productModel = new Product();
        $products = $productModel->getAll();

        $this->render('index', compact('title', 'pageTitle', 'products'));
    }

    public function add()
    {
        $title = 'Thêm sản phẩm mới';
        $pageTitle = 'Thêm sản phẩm';

        $productModel = new Product();
        $categories = $productModel->getCategories();

        $this->render('add', compact('title', 'pageTitle', 'categories'));
    }

    public function edit($id)
    {
        $title = 'Chỉnh sửa sản phẩm';
        $pageTitle = 'Sửa sản phẩm';

        $productModel = new Product();
        $product = $productModel->find($id);
        $variants = $productModel->getVariants($id);
        $categories = $productModel->getCategories();

        $this->render('edit', compact('title', 'pageTitle', 'product', 'variants', 'categories'));
    }

   public function store()
{
    $productModel = new Product();

    $_POST['image'] = $this->uploadImage('image');

    if (!empty($_FILES['variant_image']['name'])) {
        foreach ($_FILES['variant_image']['name'] as $key => $name) {
            $_POST['variant_image'][$key] = $this->uploadVariantImage($key);
        }
    }

    $productModel->create($_POST);

    header('Location: index.php?page=products');
    exit;
}

public function update()
{
    $productModel = new Product();

    $oldProduct = $productModel->find($_POST['id']);

    $_POST['image'] = $oldProduct['image'];

    if (!empty($_FILES['image']['name'])) {
        $_POST['image'] = $this->uploadImage('image');
    }

    if (!empty($_FILES['variant_image']['name'])) {
        foreach ($_FILES['variant_image']['name'] as $key => $name) {
            if (!empty($name)) {
                $_POST['variant_image'][$key] = $this->uploadVariantImage($key);
            } else {
                $_POST['variant_image'][$key] = $_POST['old_variant_image'][$key] ?? '';
            }
        }
    }

    $productModel->update($_POST);

    header('Location: index.php?page=products');
    exit;
}

private function uploadImage($inputName)
{
    if (empty($_FILES[$inputName]['name'])) {
        return '';
    }

    $uploadDir = __DIR__ . '/../../uploads/products/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . '_' . basename($_FILES[$inputName]['name']);
    $targetPath = $uploadDir . $fileName;

    move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetPath);

    return 'uploads/products/' . $fileName;
}

private function uploadVariantImage($key)
{
    if (empty($_FILES['variant_image']['name'][$key])) {
        return '';
    }

    $uploadDir = __DIR__ . '/../../uploads/products/variants/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . '_' . basename($_FILES['variant_image']['name'][$key]);
    $targetPath = $uploadDir . $fileName;

    move_uploaded_file($_FILES['variant_image']['tmp_name'][$key], $targetPath);

    return 'uploads/products/variants/' . $fileName;
}

    public function delete($id)
    {
        $productModel = new Product();
        $productModel->delete($id);

        header('Location: index.php?page=products');
        exit;
    }
}