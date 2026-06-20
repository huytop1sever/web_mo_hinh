<?php

class ProductController
{
public function index()
{
    $title = 'Quản lý sản phẩm';
    $pageTitle = 'Danh sách sản phẩm';

    $productModel = new Product();

    $keyword = $_GET['keyword'] ?? '';
    $categoryId = $_GET['category_id'] ?? '';
    $priceRange = $_GET['price_range'] ?? '';
    $sort = $_GET['sort'] ?? '';

    $limit = 10;
    $currentPage = isset($_GET['p']) ? (int)$_GET['p'] : 1;

    if ($currentPage < 1) {
        $currentPage = 1;
    }

    $offset = ($currentPage - 1) * $limit;

    $totalProducts = $productModel->countAll($keyword, $categoryId, $priceRange);
    $totalPages = (int) ceil($totalProducts / $limit);

    if ($totalPages < 1) {
        $totalPages = 1;
    }
    $products = $productModel->getAll($keyword, $categoryId, $limit, $offset, $priceRange, $sort);
    $categories = $productModel->getCategories();

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

        $productId = $productModel->create($_POST);

        if (!empty($_POST['variants'])) {
            $productModel->saveVariants($productId, $_POST['variants']);
        }

        // Upload ảnh phụ
        $subImages = $this->uploadSubImages();
        if (!empty($subImages)) {
            $productModel->saveImages($productId, $subImages);
        }

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
        $variants = $productModel->getVariants($id);

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

        $variants = $_POST['variants'] ?? [];
        $productModel->updateVariants($_POST['id'], $variants);

        // Upload ảnh phụ (thay mới nếu có upload)
        $subImages = $this->uploadSubImages();
        if (!empty($subImages)) {
            $productModel->deleteImages((int)$_POST['id']);
            $productModel->saveImages((int)$_POST['id'], $subImages);
        }

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

        $allowTypes = ['jpg', 'jpeg', 'png', 'webp'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileType, $allowTypes)) {
            return '';
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            return 'uploads/products/' . $fileName;
        }

        return '';
    }

    private function uploadSubImages(): array
    {
        if (
            empty($_FILES['sub_images']) ||
            empty($_FILES['sub_images']['name']) ||
            !is_array($_FILES['sub_images']['name'])
        ) {
            return [];
        }

        $uploadDir = '../uploads/products/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $allowTypes = ['jpg', 'jpeg', 'png', 'webp'];
        $paths = [];

        foreach ($_FILES['sub_images']['name'] as $index => $originalName) {
            if (empty($originalName)) {
                continue;
            }

            $tmpName = $_FILES['sub_images']['tmp_name'][$index] ?? '';
            if (empty($tmpName)) {
                continue;
            }

            $fileExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            if (!in_array($fileExt, $allowTypes)) {
                continue;
            }

            $fileName = time() . '_' . $index . '_' . basename($originalName);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($tmpName, $targetPath)) {
                $paths[] = 'uploads/products/' . $fileName;
            }
        }

        return $paths;
    }
}
?>
