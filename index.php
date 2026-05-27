<?php

require_once 'Controllers/client/HomeController.php';
require_once 'Controllers/client/CartController.php';
require_once 'Controllers/client/CheckoutController.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'home':
        (new HomeController())->index();
        break;

    case 'cart':
        (new CartController())->index();
        break;

    case 'checkout':
        (new CheckoutController())->index();
        break;

    default:
        echo "404";
        break;
}