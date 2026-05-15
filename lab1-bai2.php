<?php

session_start();

if (!isset($_SESSION['products'])) {

    $_SESSION['products'] = [

        [
            "id" => 1,
            "name" => "Bãi Săn Phần 1: Giếng Cổ",
            "price" => 70950,
            "image" => "https://cdn1.fahasa.com/media/catalog/product/c/0/c076b4d8-8586-402b-b574-36efb8dea02b.jpg",
        ],

        [
            "id" => 2,
            "name" => "Chiếc Bản Lề Cong",
            "price" => 67500,
            "image" => "https://cdn1.fahasa.com/media/catalog/product/i/m/image_195509_1_12678.jpg",
        ],

        [
            "id" => 3,
            "name" => "Người Truy Án",
            "price" => 202500,
            "image" => "https://cdn1.fahasa.com/media/catalog/product/i/m/image_235785.jpg",
        ]

    ];
}

?>

<form action="xuly.php" method="POST">

    <input type="text" name="name" placeholder="Tên sách">
    <br><br>

    <input type="number" name="price" placeholder="Giá">
    <br><br>

    <input type="text" name="image" placeholder="Link ảnh">
    <br><br>

    <button type="submit">Gửi đi</button>

</form>

<hr>

<?php

foreach ($_SESSION['products'] as $product) {

    echo "<h3>" . $product['name'] . "</h3>";
    echo number_format($product['price']) . " VND<br>";
    echo "<img src='{$product['image']}' width='150'>";
    echo "<hr>";
}

?>