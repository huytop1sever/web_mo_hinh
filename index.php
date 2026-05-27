<?php

require_once 'Controllers/client/HomeController.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    default:
        echo "404";
        break;
}