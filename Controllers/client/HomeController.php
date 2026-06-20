<?php

class HomeController
{
    public function index()
    {
        require_once 'Models/Product.php';

        $productModel = new Product();
        $products = $productModel->getAll('', '', 8, 0);

        require_once 'Views/client/home/index.php';
    }
}