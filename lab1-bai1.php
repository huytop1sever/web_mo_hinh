<?php

$products = [
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

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 1</title>
<link rel=stylesheet href="style.css">

</head>
<body>

<h1>Danh sách sản phẩm</h1>

<div class="container">

    <?php foreach($products as $pro){ ?>

        <div class="card">

            <img src="<?= $pro['image'] ?>" alt="">

            <div class="title">
                <?= $pro['name'] ?>
            </div>

            <div class="price">
                <?= number_format($pro['price']) ?> VNĐ
            </div>

        </div>

    <?php } ?>

</div>

</body>
</html>