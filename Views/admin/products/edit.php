<?php

$product = $product ?? [
    'id' => '',
    'image' => '',
    'name' => '',
    'category' => 'Gundam',
    'price' => 0,
    'stock' => 0,
    'status' => 'Đang bán',
];

?>

<div class="box form-box">
    <div class="box-title">
        <h2>Sửa sản phẩm</h2>
    </div>

    <form action="index.php?act=product-update" method="POST" class="form-container">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" name="name" id="name" value="<?= $product['name'] ?>" required>
        </div>

        <div class="form-group">
            <label for="image">Link ảnh sản phẩm</label>
            <input type="text" name="image" id="image" value="<?= $product['image'] ?>">
        </div>

        <div class="form-group">
            <label>Ảnh hiện tại</label>
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="form-product-preview">
        </div>

        <div class="form-group">
            <label for="category">Danh mục</label>
            <select name="category" id="category">
                <option value="Gundam" <?= ($product['category'] ?? '') === 'Gundam' ? 'selected' : '' ?>>Gundam</option>
                <option value="Anime Figure" <?= ($product['category'] ?? '') === 'Anime Figure' ? 'selected' : '' ?>>Anime Figure</option>
                <option value="Marvel" <?= ($product['category'] ?? '') === 'Marvel' ? 'selected' : '' ?>>Marvel</option>
                <option value="Pokemon" <?= ($product['category'] ?? '') === 'Pokemon' ? 'selected' : '' ?>>Pokemon</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" id="price" min="0" value="<?= $product['price'] ?>" required>
        </div>

        <div class="form-group">
            <label for="stock">Tồn kho</label>
            <input type="number" name="stock" id="stock" min="0" value="<?= $product['stock'] ?>" required>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" id="status">
                <option value="Đang bán" <?= $product['status'] === 'Đang bán' ? 'selected' : '' ?>>Đang bán</option>
                <option value="Sắp hết" <?= $product['status'] === 'Sắp hết' ? 'selected' : '' ?>>Sắp hết</option>
                <option value="Hết hàng" <?= $product['status'] === 'Hết hàng' ? 'selected' : '' ?>>Hết hàng</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Cập nhật</button>
            <a href="index.php?act=products" class="btn-secondary">Hủy bỏ</a>
        </div>
    </form>
</div>