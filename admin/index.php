<?php

session_start();

require_once '../config/database.php';

// Models
require_once '../Models/Product.php';
require_once '../Models/Category.php';
require_once '../Models/Post.php';
require_once '../Models/User.php';
require_once '../Models/Order.php';

// Controllers
require_once '../Controllers/admin/DashboardController.php';
require_once '../Controllers/admin/CategoryController.php';
require_once '../Controllers/admin/PostController.php';
require_once '../Controllers/admin/ProductController.php';
require_once '../Controllers/admin/UserController.php';
require_once '../Controllers/admin/OrderController.php';

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

    case 'dashboard':
        (new DashboardController())->index();
        break;

    case 'products':
        (new ProductController())->index();
        break;

    case 'product-add':
        (new ProductController())->add();
        break;

    case 'product-edit':
        (new ProductController())->edit($_GET['id'] ?? 0);
        break;

    case 'product-store':
        (new ProductController())->store();
        break;

    case 'product-update':
        (new ProductController())->update();
        break;
    
    case 'product-delete':
        (new ProductController())->delete($_GET['id'] ?? 0);
        break;

    case 'categories':
        (new CategoryController())->index();
        break;

    case 'category-add':
        (new CategoryController())->add();
        break;

    case 'category-edit':
        (new CategoryController())->edit($_GET['id'] ?? 0);
        break;

    case 'category-store':
        (new CategoryController())->store();
        break;

    case 'category-update':
        (new CategoryController())->update();
        break;

    case 'category-delete':
        (new CategoryController())->delete($_GET['id'] ?? 0);
        break;

    case 'posts':
        (new PostController())->index();
        break;

    case 'post-create':
        (new PostController())->create();
    break;

    case 'post-store':
    (new PostController())->store();
    break;

    case 'post-edit':
        (new PostController())->edit($_GET['id'] ?? 0);
        break;

    case 'post-update':
    (new PostController())->update();
    break;

    case 'post-delete':
    (new PostController())->delete($_GET['id'] ?? 0);
    break;

    case 'orders':
        (new OrderController())->index();
        break;

    case 'order-detail':
        (new OrderController())->detail();
        break;

    case 'order-update-status':
        (new OrderController())->updateStatus();
        break;

    case 'order-delete':
        (new OrderController())->delete();
        break;

    case 'users':
        (new UserController())->index();
        break;

    case 'user-lock':
        (new UserController())->lock();
        break;

    case 'user-unlock':
        (new UserController())->unlock();
        break;

    case 'user-delete':
        (new UserController())->delete();
        break;

    default:
        (new DashboardController())->index();
        break;
}
