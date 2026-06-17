<?php

class ProductController
{
    public function index()
    {
        $productModel = new Product();

        $limit = 6;

        $pageNow = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $keyword = $_GET['keyword'] ?? '';
        $categoryId = $_GET['category_id'] ?? '';
        $priceRange = $_GET['price_range'] ?? '';
        $sort = $_GET['sort'] ?? '';

        if ($pageNow < 1) {
            $pageNow = 1;
        }

        $offset = ($pageNow - 1) * $limit;

        $totalProducts = $productModel->countAll($keyword, $categoryId, $priceRange);
        $totalPages = (int) ceil($totalProducts / $limit);

        if ($totalPages < 1) {
            $totalPages = 1;
        }

        $products = $productModel->getAll($keyword, $categoryId, $limit, $offset, $priceRange, $sort);
        $categories = $productModel->getCategoriesWithCount();

        require_once 'Views/client/product/index.php';
    }

    public function detail()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id <= 0) {
            header('Location: index.php?page=product');
            exit;
        }

        $productModel = new Product();
        $product = $productModel->find($id);

        if (!$product) {
            // Chuyển hướng nếu không tìm thấy sản phẩm hoặc ID không hợp lệ
            header('Location: index.php?page=product');
            exit;
        }

        $variants = $productModel->getVariants($id);
        
        // Lấy sản phẩm liên quan (cùng danh mục, lấy 4 sản phẩm)
        $relatedProducts = $productModel->getAll('', $product['category_id'] ?? '', 4, 0);

        require_once 'Views/client/product/detail.php';
    }
}