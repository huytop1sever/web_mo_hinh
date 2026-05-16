<?php
session_start();

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
            "name" => "Sứ Mệnh Hail Mary - Project Hail Mary",
            "price" => 136000,
            "image" => "https://cdn1.fahasa.com/media/catalog/product/b/_/b_a-1_7_12.jpg"
        ],
        [
            "id" => 3,
            "name" => "Người Đàn Ông Mang Tên OVE (Tái Bản)",
            "price" => 115200,
            "image" => "https://cdn1.fahasa.com/media/catalog/product/8/9/8934974182375.jpg"
        ],
    ];
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $filename = time() . '_' . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
            $image = $uploadDir . $filename;
        }
    }

    if (!empty($name) && is_numeric($price) && $price >= 0 && !empty($image)) {
        $lastProduct = end($_SESSION['products']);
        $newId = $lastProduct ? $lastProduct['id'] + 1 : 1;

        $newProduct = [
            "id" => $newId,
            "name" => $name,
            "price" => (float)$price,
            "image" => $image
        ];
        $_SESSION['products'][] = $newProduct;
        
        reset($_SESSION['products']);
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm - Lab 1</title>
    <link rel="stylesheet" href="lab1.css">
</head>
<body>
<div class="form-container">
    <h2>Thêm sản phẩm mới</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên sản phẩm:</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Giá sản phẩm:</label>
            <input type="number" name="price" min="0" required>
        </div>
        <div class="form-group">
            <label>Chọn ảnh sản phẩm:</label>
            <input type="file" name="image" accept="image/*" required>
        </div>
        <button type="submit" name="add_product">Gửi đi</button>
    </form>
</div>

<h2>Danh sách sản phẩm hiện tại</h2>
<div class="container">
    <?php foreach ($_SESSION['products'] as $pro): ?>
        <div class="product-card">
            <img src="<?php echo htmlspecialchars($pro['image']); ?>" 
                 alt="<?php echo htmlspecialchars($pro['name']); ?>" 
                 style="width:100px;">
            <div class="product-name"><?php echo htmlspecialchars($pro['name']); ?></div>
            <span class="price"><?php echo number_format($pro['price'], 0, ',', '.'); ?> đ</span>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>