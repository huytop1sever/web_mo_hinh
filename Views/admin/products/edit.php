<?php
$categories = $categories ?? [];
$product = $product ?? null;
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

    <?php if (!empty($product)): ?>

        <form id="productForm"
      data-mode="edit"
      action="index.php?page=product-update"
      method="post"
      enctype="multipart/form-data"
      class="product-form-card">

            <input type="hidden" name="id" value="<?= $product['id'] ?>">

            <div class="form-left">

                <div class="form-group">
                    <label for="title">Tên sản phẩm <span>*</span></label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="<?= htmlspecialchars($product['title']) ?>"
                        placeholder="Nhập tên sản phẩm">
                </div>

                <div class="form-group">
                    <label for="category_id">Danh mục <span>*</span></label>
                    <select id="category_id" name="category_id">
                        <option value="">-- Chọn danh mục --</option>

                        <?php foreach ($categories as $category): ?>
                            <option
                                value="<?= $category['id'] ?>"
                                <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả ngắn</label>
                    <textarea id="description" name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="content">Nội dung chi tiết</label>
                    <textarea id="content" name="content" rows="7"><?= htmlspecialchars($product['content']) ?></textarea>
                </div>

            </div>

            <div class="form-right">

                <label class="image-upload-box" for="image">
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewProductImage(event)">

                    <div class="upload-placeholder" id="uploadPlaceholder" style="<?= !empty($product['image']) ? 'display:none;' : '' ?>">
                        <i class='bx bx-image-add'></i>
                        <h3>Chọn ảnh mới</h3>
                        <p>PNG, JPG, JPEG</p>
                    </div>

                    <img
                        id="previewImage"
                        src="<?= !empty($product['image']) ? '../' . htmlspecialchars($product['image']) : '' ?>"
                        alt="Preview"
                        style="<?= !empty($product['image']) ? 'display:block;' : 'display:none;' ?>">
                </label>

                <div class="form-actions">
                    <button type="submit" class="btn-save">
                        <i class='bx bx-save'></i>
                        Cập nhật
                    </button>

                    <a href="index.php?page=products" class="btn-cancel">
                        Hủy
                    </a>
                </div>

            </div>

        </form>

    <?php else: ?>

        <div class="product-form-card">
            <p>Không tìm thấy sản phẩm</p>
        </div>

    <?php endif; ?>

</div>