<?php

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

    case 'products':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->index();

        break;

    case 'product-add':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->add();

        break;

    case 'product-edit':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->edit($_GET['id'] ?? 0);

        break;

    case 'product-store':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->store();

        break;

    case 'product-update':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->update();

        break;

    case 'categories':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->index();

        break;

    case 'category-add':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->add();

        break;

    case 'category-edit':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->edit($_GET['id'] ?? 0);

        break;

    case 'category-store':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->store();

        break;

    case 'category-update':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->update();

        break;

    case 'category-delete':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->delete($_GET['id'] ?? 0);

        break;

    case 'posts':
        require_once '../Controllers/admin/PostController.php';
        $controller = new PostController();
        $controller->index();
        break;

    case 'users':
        require_once '../Controllers/admin/UserController.php';
        $controller = new UserController();
        $controller->index();
        break;

    case 'orders':
        require_once '../Controllers/admin/OrderController.php';
        $controller = new OrderController();
        $controller->index();
        break;

    case 'order-detail':
        require_once '../Controllers/admin/OrderController.php';
        $controller = new OrderController();
        $controller->detail();
        break;

    case 'post-create':
        require_once '../Controllers/admin/PostController.php';
        $controller = new PostController();
        $controller->create();
        break;

    case 'post-edit':
        require_once '../Controllers/admin/PostController.php';
        $controller = new PostController();
        $controller->edit();
        break;

    case 'post-delete':
        require_once '../Controllers/admin/PostController.php';
        $controller = new PostController();
        $controller->delete();
        break;

    case 'comments':
        require_once '../Controllers/admin/CommentController.php';
        $controller = new CommentController();
        $controller->index();
        break;


    case 'products':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->index();

        break;

    case 'product-add':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->add();

        break;

    case 'product-edit':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->edit($_GET['id'] ?? 0);

        break;

    case 'product-store':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->store();

        break;

    case 'product-update':

        require_once '../Controllers/admin/ProductController.php';

        $controller = new ProductController();
        $controller->update();

        break;

    case 'categories':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->index();

        break;

    case 'category-add':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->add();

        break;

    case 'category-edit':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->edit($_GET['id'] ?? 0);

        break;

    case 'category-store':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->store();

        break;

    case 'category-update':

        require_once '../Controllers/admin/CategoryController.php';

        $controller = new CategoryController();
        $controller->update();

        break;

    case 'dashboard':

        require_once '../Controllers/admin/DashboardController.php';

        $controller = new DashboardController();
        $controller->index();

        break;

    default:

        require_once '../Controllers/admin/DashboardController.php';

        $controller = new DashboardController();
        $controller->index();

        break;
}
