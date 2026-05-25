<?php

$product = $product ?? [
    'id' => '',
    'name' => '',
    'category' => 'Gundam',
    'price' => 0,
    'stock' => 0,
    'status' => 'Dang ban',
];

?>

<div class="box form-box">
    <div class="box-title">
        <h2>Sua san pham</h2>
    </div>

    <form action="index.php?act=product-update" method="POST" class="form-container">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="form-group">
            <label for="name">Ten san pham</label>
            <input type="text" name="name" id="name" value="<?= $product['name'] ?>" required>
        </div>

        <div class="form-group">
            <label for="category">Danh muc</label>
            <select name="category" id="category">
                <option value="Gundam" <?= ($product['category'] ?? '') === 'Gundam' ? 'selected' : '' ?>>Gundam</option>
                <option value="Anime Figure" <?= ($product['category'] ?? '') === 'Anime Figure' ? 'selected' : '' ?>>Anime Figure</option>
                <option value="Marvel" <?= ($product['category'] ?? '') === 'Marvel' ? 'selected' : '' ?>>Marvel</option>
                <option value="Pokemon" <?= ($product['category'] ?? '') === 'Pokemon' ? 'selected' : '' ?>>Pokemon</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Gia</label>
            <input type="number" name="price" id="price" min="0" value="<?= $product['price'] ?>" required>
        </div>

        <div class="form-group">
            <label for="stock">Ton kho</label>
            <input type="number" name="stock" id="stock" min="0" value="<?= $product['stock'] ?>" required>
        </div>

        <div class="form-group">
            <label for="status">Trang thai</label>
            <select name="status" id="status">
                <option value="Dang ban" <?= $product['status'] === 'Dang ban' ? 'selected' : '' ?>>Dang ban</option>
                <option value="Sap het" <?= $product['status'] === 'Sap het' ? 'selected' : '' ?>>Sap het</option>
                <option value="Het hang" <?= $product['status'] === 'Het hang' ? 'selected' : '' ?>>Het hang</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Cap nhat</button>
            <a href="index.php?act=products" class="btn-secondary">Huy bo</a>
        </div>
    </form>
</div>
