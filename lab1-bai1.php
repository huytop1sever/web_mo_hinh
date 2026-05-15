<?php

$products = [
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

foreach ($products as $product) {
    echo "<div>";
    echo "<h2>{$product['name']}</h2>";
    echo "<p>Giá: " . number_format($product['price']) . " VND</p>";
    echo "<img src='{$product['image']}' width='200'>";
    echo "</div><hr>";
}