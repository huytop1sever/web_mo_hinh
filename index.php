<?php
session_start();
ob_start();

require_once 'config/database.php';
require_once 'Models/Cart.php';

require_once 'Controllers/client/HomeController.php';
require_once 'Controllers/client/CartController.php';
require_once 'Controllers/client/CheckoutController.php';
require_once 'Controllers/client/ProductController.php';
require_once 'Controllers/client/PostController.php';

require_once 'Controllers/AuthController.php';


//models
require_once 'Models/Product.php';
require_once 'Models/Category.php';
require_once 'Models/User.php';
require_once 'Models/Order.php';
require_once 'Models/Post.php';


$page = $_GET['page'] ?? 'home';

$action = $_GET['action'] ?? null;

// Handle AJAX cart actions (no header/footer) before rendering full page
if ($page === 'cart' && in_array($action, ['add', 'remove', 'update'])) {
    $cart = new CartController();

    switch ($action) {
        case 'add':
            $cart->add();
            break;
        case 'remove':
            $cart->remove();
            break;
        case 'update':
            $cart->update();
            break;
    }

    exit;
}

// Check login requirement BEFORE including header
$requireLogin = in_array($page, ['cart', 'checkout', 'profile']);
if ($requireLogin && empty($_SESSION['user'])) {
    ob_end_clean();
    header('Location: index.php?page=login');
    exit;
}

require_once 'Views/client/layouts/header.php';

switch ($page) {
    case 'home':
        (new HomeController())->index();
        break;

    case 'cart':
        (new CartController())->index();
        break;

    case 'product':
        (new ProductController())->index();
        break;

    case 'product-detail':
        (new ProductController())->detail();
        break;

    case 'post':
        (new PostController())->index();
        break;

    case 'post-detail':
        (new PostController())->detail();
        break;

    case 'checkout':
        (new CheckoutController())->index();
        break;

    case 'login':
        (new AuthController())->login();
        break;

    case 'forgot-password':
        (new AuthController())->forgotPassword();
        break;

    case 'reset-password':
        (new AuthController())->resetPassword();
        break;

    case 'register':
        (new AuthController())->register();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    case 'profile':
        (new AuthController())->profile();
        break;

    default:
        echo "404";
        break;
}

require_once 'Views/client/layouts/Footer.php';
