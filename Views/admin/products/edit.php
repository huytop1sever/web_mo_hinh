<?php

$categories = $categories ?? [];
$product = $product ?? [];
$variants = $variants ?? [];

$currentImage = $product['image'] ?? '';
$imagePath = '';

if (!empty($currentImage)) {
    if (str_contains($currentImage, 'uploads/products/')) {
        $imagePath = '../' . $currentImage;
    } elseif (str_contains($currentImage, 'products/')) {
        $imagePath = '../uploads/' . $currentImage;
    } else {
        $imagePath = '../uploads/products/' . $currentImage;
    }
}

if (empty($variants)) {
    $variants = [
        [
            'id' => '',
            'variant_name' => '',
            'sku' => '',
            'price' => '',
            'sale_price' => '',
            'stock' => '',
            'status' => 1
        ]
    ];
}

?>

<div class="product-form-page">

    <div class="product-form-header">
        <div>
            <h2>Sửa sản phẩm</h2>
            <p>Cập nhật thông tin sản phẩm</p>
        </div>

        <a href="index.php?page=products" class="btn-back">
            <i class='bx bx-arrow-back'></i>
            Quay lại
        </a>
    </div>

    <form id="productForm"
          data-mode="edit"
          action="index.php?page=product-update&id=<?= htmlspecialchars($product['id'] ?? '') ?>"
          method="post"
          enctype="multipart/form-data"
          class="product-form-card">

        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id'] ?? '') ?>">

        <div class="form-left">

            <div class="form-group">
                <label for="title">Tên sản phẩm <span>*</span></label>
                <input type="text"
                       id="title"
                       name="title"
                       value="<?= htmlspecialchars($product['title'] ?? '') ?>"
                       placeholder="Ví dụ: Goku Mui">
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="category_id">Danh mục <span>*</span></label>

                <select id="category_id" name="category_id">
                    <option value="">-- Chọn danh mục --</option>

                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['id']) ?>"
                            <?= (($product['category_id'] ?? '') == $category['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="description">Mô tả ngắn <span>*</span></label>
                <textarea id="description"
                          name="description"
                          rows="4"
                          placeholder="Nhập mô tả ngắn cho sản phẩm"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="content">Nội dung chi tiết <span>*</span></label>
                <textarea id="content"
                          name="content"
                          rows="7"
                          placeholder="Nhập nội dung chi tiết sản phẩm"><?= htmlspecialchars($product['content'] ?? '') ?></textarea>
                <span class="error-message"></span>
            </div>

            <div class="variant-box">
                <div class="variant-title">
                    <h3>Biến thể sản phẩm</h3>

                    <button type="button" class="btn-add-variant" onclick="addVariant()">
                        <i class='bx bx-plus'></i>
                        Thêm biến thể
                    </button>
                </div>

                <div id="variantList">

                    <?php foreach ($variants as $index => $variant): ?>
                        <div class="variant-item">

                            <?php if ($index > 0): ?>
                                <button type="button" class="btn-remove-variant">
                                    <i class='bx bx-x'></i>
                                </button>
                            <?php endif; ?>

                            <input type="hidden"
                                   name="variants[<?= $index ?>][id]"
                                   value="<?= htmlspecialchars($variant['id'] ?? '') ?>">

                            <div class="variant-grid">

                                <div class="form-group">
                                    <label>Tên biến thể <span>*</span></label>
                                    <input type="text"
                                           name="variants[<?= $index ?>][variant_name]"
                                           value="<?= htmlspecialchars($variant['variant_name'] ?? '') ?>"
                                           placeholder="Ví dụ: Size 28cm">
                                    <span class="error-message"></span>
                                </div>

                                <div class="form-group">
                                    <label>Mã SKU</label>
                                    <input type="text"
                                           name="variants[<?= $index ?>][sku]"
                                           value="<?= htmlspecialchars($variant['sku'] ?? '') ?>"
                                           placeholder="Tự động tạo">
                                    <span class="error-message"></span>
                                </div>

                                <div class="form-group">
                                    <label>Giá <span>*</span></label>
                                    <input type="number"
                                           name="variants[<?= $index ?>][price]"
                                        value="<?= !empty($variant['price']) ? (int)$variant['price'] : '' ?>"                                           placeholder="1200000">
                                    <span class="error-message"></span>
                                </div>

                                <div class="form-group">
                                    <label>Giá sale</label>
                                    <input type="number"
                                           name="variants[<?= $index ?>][sale_price]"
                                           value="<?= !empty($variant['sale_price']) ? (int)$variant['sale_price'] : '' ?>"
                                           placeholder="Để trống nếu không sale">
                                    <span class="error-message"></span>
                                </div>

                                <div class="form-group">
                                    <label>Số lượng <span>*</span></label>
                                    <input type="number"
                                           name="variants[<?= $index ?>][stock]"
                                           value="<?= !empty($variant['stock']) ? (int)$variant['stock'] : '' ?>"
                                           placeholder="20">
                                    <span class="error-message"></span>
                                </div>

                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="variants[<?= $index ?>][status]">
                                        <option value="1" <?= (($variant['status'] ?? 1) == 1) ? 'selected' : '' ?>>
                                            Hiển thị
                                        </option>
                                        <option value="0" <?= (($variant['status'] ?? 1) == 0) ? 'selected' : '' ?>>
                                            Ẩn
                                        </option>
                                    </select>
                                    <span class="error-message"></span>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>

        <div class="form-right">

            <div class="form-group image-group">

                <label class="image-upload-box <?= !empty($imagePath) ? 'has-image' : '' ?>"
                       id="uploadBox"
                       for="image">

                    <input type="file"
                           id="image"
                           name="image"
                           accept="image/png,image/jpeg,image/jpg,image/webp"
                           hidden>

                    <img id="previewImage"
                         src="<?= htmlspecialchars($imagePath) ?>"
                         alt="">

                    <div class="upload-placeholder">
                        <i class='bx bx-image-add'></i>

                        <h3>
                            <?= !empty($imagePath) ? 'Đổi ảnh sản phẩm' : 'Chọn ảnh sản phẩm' ?>
                        </h3>

                        <p>PNG, JPG, JPEG, WEBP</p>
                    </div>

                </label>

                <span class="image-error error-message"></span>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class='bx bx-save'></i>
                    Cập nhật sản phẩm
                </button>

                <a href="index.php?page=products" class="btn-cancel">
                    Hủy
                </a>
            </div>

        </div>

    </form>

</div>