<?php

class HomeController
{
    public function index()
    {
        require_once 'Models/Product.php';
        require_once 'Models/Category.php';
        require_once 'Models/Post.php';

        $productModel = new Product();
        $categoryModel = new Category();
        $postModel = new Post();

        $products = $productModel->getAll('', '', 8, 0);
        $categories = $categoryModel->getAll();
        $posts = $postModel->getAll('', '', 'published');

        require_once 'Views/client/home/index.php';
    }
}