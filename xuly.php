<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $product = [

        "id" => count($_SESSION['products']) + 1,
        "name" => $_POST['name'],
        "price" => $_POST['price'],
        "image" => $_POST['image']

    ];

    $_SESSION['products'][] = $product;

    header("Location: lab1-bai2.php");
    exit();
}

?>