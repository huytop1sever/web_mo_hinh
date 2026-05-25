<?php

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'products':
        require_once '../Controllers/client/ProductController.php';
        break;

    case 'cart':
        require_once '../Controllers/client/CartController.php';
        break;

    case 'checkout':
        require_once '../Controllers/client/CheckoutController.php';
        break;

    default:
        require_once '../Controllers/client/HomeController.php';
        break;
}