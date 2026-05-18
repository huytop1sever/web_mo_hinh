<?php

session_start();

if(isset($_GET['reset'])){

    unset($_SESSION['products']);

    header("Location: lab1-bai2.php");
    exit;
}

if (!isset($_SESSION['products'])) {

    $_SESSION['products'] = [
        [
            "id" => 1,
            "name" => "Hồ Điệp Và Kình Ngư",
            "price" => 104000,
            "image" => "https://cdn1.fahasa.com/media/catalog/product/b/i/bia-2d_ho-diep-va-kinh-ngu_17307.jpg"
        ],
        [
            "id" => 2,
            "name" => "Sứ Mệnh Hail Mary",
            "price" => 136000,
            "image" => "https://cdn1.fahasa.com/media/catalog/product/b/_/b_a-1_7_12.jpg"
        ],
        [
            "id" => 3,
            "name" => "Người Đàn Ông Mang Tên OVE",
            "price" => 115200,
            "image" => "https://cdn1.fahasa.com/media/catalog/product/8/9/8934974182375.jpg"
        ],
    ];
}

if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $newProduct = [
        "id" => count($_SESSION['products']) + 1,
        "name" => $name,
        "price" => $price,
        "image" => $image
    ];

    $_SESSION['products'][] = $newProduct;

    header("Location: lab1-bai2.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 2</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

<h1>Thêm sản phẩm</h1>

<form action="" method="POST">

    <input type="text" name="name" placeholder="Tên sản phẩm">

    <input type="number" name="price" placeholder="Giá">

    <input type="text" name="image" placeholder="Link ảnh">

    <button type="submit">
        Thêm sản phẩm
    </button>

    <a href="?reset=true">

        <button type="button">
            Xóa tất cả sản phẩm
        </button>

    </a>

</form>

<hr>

<div class="container">

    <?php foreach($_SESSION['products'] as $pro){ ?>

        <div class="card">

            <img src="<?= $pro['image'] ?>">

            <h3>
                <?= $pro['name'] ?>
            </h3>

            <p>
                <?= number_format($pro['price']) ?> VNĐ
            </p>

        </div>

    <?php } ?>

</div>

</body>
</html>