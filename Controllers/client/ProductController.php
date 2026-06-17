<?php

require_once 'Models/Product.php';

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

        if ($pageNow < 1) {
            $pageNow = 1;
        }

        $offset = ($pageNow - 1) * $limit;

        $totalProducts = $productModel->countAll($keyword, $categoryId, $priceRange);
        $totalPages = (int) ceil($totalProducts / $limit);

        if ($totalPages < 1) {
            $totalPages = 1;
        }

        $products = $productModel->getAll($keyword, $categoryId, $limit, $offset, $priceRange);
        $categories = $productModel->getCategoriesWithCount();

        require_once 'Views/client/product/index.php';
    }

    public function detail()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $productModel = new Product();

        $product = $productModel->find($id);
        $variants = $productModel->getVariants($id);

        require_once 'Views/client/product/detail.php';
    }
}