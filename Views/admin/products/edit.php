<?php

$product = $product ?? [
    'id' => '',
    'image' => '',
    'name' => '',
    'category' => 'Gundam',
    'price' => 0,
    'description' => '',
    'stock' => 0,
    'status' => 'Đang bán',
];

?>

<div class="box product-form-box">
    <div class="box-title">
        <h2>Sửa sản phẩm</h2>
    </div>

    <form action="index.php?page=product-update" method="post" class="product-form">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

                <div class="form-group">
            <label>Tên sản phẩm</label>
            <input type="text" name="title" value="<?= htmlspecialchars($product['title']) ?>" required>
        </div>

        <div class="form-group">
            <label>Danh mục</label>
            <select name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"
                        <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Ảnh sản phẩm</label>
            <input type="text" name="image" value="<?= htmlspecialchars($product['image']) ?>">
        </div>

        <div class="form-group">
            <label>Mô tả ngắn</label>
            <textarea name="description" rows="3"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Nội dung chi tiết</label>
            <textarea name="content" rows="5"><?= htmlspecialchars($product['content']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Trạng thái</label>
            <select name="status">
                <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Hiển thị</option>
                <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Ẩn</option>
            </select>
        </div>

        <h3>Biến thể sản phẩm</h3>

        <div id="variant-list">
            <?php foreach ($variants as $variant): ?>
                <div class="variant-item">
                    <input type="text" name="variant_name[]" value="<?= htmlspecialchars($variant['variant_name']) ?>" required>
                    <input type="text" name="sku[]" value="<?= htmlspecialchars($variant['sku']) ?>">
                    <input type="number" name="price[]" value="<?= $variant['price'] ?>" required>
                    <input type="number" name="sale_price[]" value="<?= $variant['sale_price'] ?>">
                    <input type="number" name="stock[]" value="<?= $variant['stock'] ?>" required>
                    <input type="text" name="variant_image[]" value="<?= htmlspecialchars($variant['image']) ?>">

                    <select name="variant_status[]">
                        <option value="1" <?= $variant['status'] == 1 ? 'selected' : '' ?>>Đang bán</option>
                        <option value="0" <?= $variant['status'] == 0 ? 'selected' : '' ?>>Ẩn</option>
                    </select>

                    <button type="button" class="btn-delete-variant" onclick="this.parentElement.remove()">Xóa</button>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="btn-secondary" onclick="addVariant()">+ Thêm biến thể</button>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Cập nhật</button>
            <a href="index.php?page=products" class="btn-secondary">Quay lại</a>
        </div>
    </form>
</div>

<script>
function addVariant() {
    const html = `
        <div class="variant-item">
            <input type="text" name="variant_name[]" placeholder="Tên biến thể" required>
            <input type="text" name="sku[]" placeholder="SKU">
            <input type="number" name="price[]" placeholder="Giá" required>
            <input type="number" name="sale_price[]" placeholder="Giá sale">
            <input type="number" name="stock[]" placeholder="Tồn kho" required>
            <input type="text" name="variant_image[]" placeholder="Ảnh biến thể">
            <select name="variant_status[]">
                <option value="1">Đang bán</option>
                <option value="0">Ẩn</option>
            </select>
            <button type="button" class="btn-delete-variant" onclick="this.parentElement.remove()">Xóa</button>
        </div>
    `;

    document.getElementById('variant-list').insertAdjacentHTML('beforeend', html);
}
</script>