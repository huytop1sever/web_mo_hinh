<?php
$categories = $categories ?? [];
?>

<div class="product-form-page">

    <div class="product-form-header">
        <div>
            <h2>Thêm sản phẩm</h2>
            <p>Nhập thông tin sản phẩm mới</p>
        </div>

        <a href="index.php?page=products" class="btn-back">
            <i class='bx bx-arrow-back'></i>
            Quay lại
        </a>
    </div>

<form id="productForm"
      data-mode="create"
      action="index.php?page=product-store"
      method="post"
      enctype="multipart/form-data"
      class="product-form-card">

        <div class="form-left">

            <div class="form-group">
                <label for="title">Tên sản phẩm <span>*</span></label>
                <input type="text" id="title" name="title" placeholder="Ví dụ: Mô hình Gojo Satoru">
            </div>

            <div class="form-group">
                <label for="category_id">Danh mục <span>*</span></label>
                <select id="category_id" name="category_id">
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Mô tả ngắn</label>
                <textarea id="description" name="description" rows="4" placeholder="Nhập mô tả ngắn cho sản phẩm"></textarea>
            </div>

            <div class="form-group">
                <label for="content">Nội dung chi tiết</label>
                <textarea id="content" name="content" rows="7" placeholder="Nhập nội dung chi tiết sản phẩm"></textarea>
            </div>

        </div>

        <div class="form-right">

            <label class="image-upload-box" for="image">
                <input type="file" id="image" name="image" accept="image/*" onchange="previewProductImage(event)">

                <div class="upload-placeholder" id="uploadPlaceholder">
                    <i class='bx bx-image-add'></i>
                    <h3>Chọn ảnh sản phẩm</h3>
                    <p>PNG, JPG, JPEG</p>
                </div>

                <img id="previewImage" src="" alt="Preview">
            </label>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class='bx bx-save'></i>
                    Lưu sản phẩm
                </button>

                <a href="index.php?page=products" class="btn-cancel">
                    Hủy
                </a>
            </div>

        </div>

    </form>
</div>
