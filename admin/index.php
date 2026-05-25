<?php

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

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


    default:

        require_once '../Controllers/admin/DashboardController.php';

        $controller = new DashboardController();
        $controller->index();

        break;
}
