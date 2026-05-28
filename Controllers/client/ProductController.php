<?php

class ProductController
{
    public function index()
    {
        require_once 'Views/client/product/index.php';
    }

    public function detail()
    {
        require_once 'Views/client/product/detail.php';
    }
}
