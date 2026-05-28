<?php

require_once 'Controllers/client/HomeController.php';
require_once 'Controllers/client/CartController.php';
require_once 'Controllers/client/CheckoutController.php';
require_once 'Controllers/client/AuthController.php';
require_once 'Controllers/client/ProductController.php';


$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'home':
        (new HomeController())->index();
        break;

    case 'cart':
        $controller = new CartController();
        $controller->index();
        break;

    case 'product':
        $controller = new ProductController();
        $controller->index();
        break;

    case 'product-detail':
        $controller = new ProductController();
        $controller->detail();
        break;

    case 'checkout':
        $controller = new CheckoutController();
        $controller->index();
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    default:
        echo "404";
        break;
}
