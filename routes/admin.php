<?php

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

    // Dashboard
    case 'dashboard':
        require_once '../Controllers/admin/DashboardController.php';
        (new DashboardController())->index();
        break;

    // Products
    case 'products':
        require_once '../Controllers/admin/ProductController.php';
        (new ProductController())->index();
        break;

    case 'product-add':
        require_once '../Controllers/admin/ProductController.php';
        (new ProductController())->add();
        break;

    case 'product-edit':
        require_once '../Controllers/admin/ProductController.php';
        (new ProductController())->edit($_GET['id'] ?? 0);
        break;

    case 'product-store':
        require_once '../Controllers/admin/ProductController.php';
        (new ProductController())->store();
        break;

    case 'product-update':
        require_once '../Controllers/admin/ProductController.php';
        (new ProductController())->update();
        break;

    // Categories
    case 'categories':
        require_once '../Controllers/admin/CategoryController.php';
        (new CategoryController())->index();
        break;

    case 'category-add':
        require_once '../Controllers/admin/CategoryController.php';
        (new CategoryController())->add();
        break;

    case 'category-edit':
        require_once '../Controllers/admin/CategoryController.php';
        (new CategoryController())->edit($_GET['id'] ?? 0);
        break;

    case 'category-store':
        require_once '../Controllers/admin/CategoryController.php';
        (new CategoryController())->store();
        break;

    case 'category-update':
        require_once '../Controllers/admin/CategoryController.php';
        (new CategoryController())->update();
        break;

    case 'category-delete':
        require_once '../Controllers/admin/CategoryController.php';
        (new CategoryController())->delete($_GET['id'] ?? 0);
        break;

    // Posts
    case 'posts':
        require_once '../Controllers/admin/PostController.php';
        (new PostController())->index();
        break;

    case 'post-create':
        require_once '../Controllers/admin/PostController.php';
        (new PostController())->create();
        break;

    case 'post-store':
        require_once '../Controllers/admin/PostController.php';
        (new PostController())->store();
        break;

    case 'post-edit':
        require_once '../Controllers/admin/PostController.php';
        (new PostController())->edit();
        break;

    case 'post-update':
        require_once '../Controllers/admin/PostController.php';
        (new PostController())->update();
        break;

    case 'post-delete':
        require_once '../Controllers/admin/PostController.php';
        (new PostController())->delete();
        break;

    // Comments
    case 'comments':
        require_once '../Controllers/admin/CommentController.php';
        (new CommentController())->index();
        break;

    // Orders
    case 'orders':
        require_once '../Controllers/admin/OrderController.php';
        (new OrderController())->index();
        break;

    case 'order-detail':
        require_once '../Controllers/admin/OrderController.php';
        (new OrderController())->detail();
        break;

    case 'order-update-status':
        require_once '../Controllers/admin/OrderController.php';
        (new OrderController())->updateStatus();
        break;

    case 'order-delete':
        require_once '../Controllers/admin/OrderController.php';
        (new OrderController())->delete();
        break;

    // Users
    case 'users':
        require_once '../Controllers/admin/UserController.php';
        (new UserController())->index();
        break;

    case 'user-store':
        require_once '../Controllers/admin/UserController.php';
        (new UserController())->store();
        break;

    case 'user-update':
        require_once '../Controllers/admin/UserController.php';
        (new UserController())->update();
        break;

    case 'user-lock':
        require_once '../Controllers/admin/UserController.php';
        (new UserController())->lock();
        break;

    case 'user-unlock':
        require_once '../Controllers/admin/UserController.php';
        (new UserController())->unlock();
        break;

    case 'user-delete':
        require_once '../Controllers/admin/UserController.php';
        (new UserController())->delete();
        break;

    default:
        require_once '../Controllers/admin/DashboardController.php';
        (new DashboardController())->index();
        break;
}
