<?php
session_start();

require_once 'config/database.php';

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

require_once 'Views/client/layouts/header.php';

switch ($page) {
    case 'home':
        (new HomeController())->index();
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

require_once 'Views/client/layouts/footer.php';
