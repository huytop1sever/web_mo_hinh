<?php

$categories = $categories ?? [];
$product = $product ?? [];

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

        <input type="hidden"
               name="old_image"
               value="<?= htmlspecialchars($currentImage) ?>">

        <div class="form-left">

            <div class="form-group">
                <label for="title">Tên sản phẩm <span>*</span></label>
                <input type="text"
                       id="title"
                       name="title"
                       value="<?= htmlspecialchars($product['title'] ?? '') ?>"
                       placeholder="Ví dụ: Mô hình Gojo Satoru">
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