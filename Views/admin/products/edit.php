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

<div class="box form-box product-form-box">
    <div class="box-title">
        <div>
            <h2>Sửa sản phẩm</h2>
            <p>Cập nhật thông tin sản phẩm mô hình</p>
        </div>
    </div>

    <form action="index.php?page=product-update" method="POST" enctype="multipart/form-data" class="form-container" id="productForm" data-mode="edit">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <input type="hidden" name="old_image" value="<?= $product['image'] ?>">

        <div class="form-grid">
            <div class="form-left">
                <div class="form-group">
                    <label for="name">Tên sản phẩm <span>*</span></label>
                    <input type="text" name="name" id="name" value="<?= $product['name'] ?>" placeholder="VD: Luffy Gear 5 Figure">
                    <small class="error-message"></small>
                </div>

                <div class="form-group">
                    <label for="category">Danh mục <span>*</span></label>
                    <select name="category" id="category">
                        <option value="">-- Chọn danh mục --</option>
                        <option value="Gundam" <?= ($product['category'] ?? '') === 'Gundam' ? 'selected' : '' ?>>Gundam</option>
                        <option value="Anime Figure" <?= ($product['category'] ?? '') === 'Anime Figure' ? 'selected' : '' ?>>Anime Figure</option>
                        <option value="Marvel" <?= ($product['category'] ?? '') === 'Marvel' ? 'selected' : '' ?>>Marvel</option>
                        <option value="Pokemon" <?= ($product['category'] ?? '') === 'Pokemon' ? 'selected' : '' ?>>Pokemon</option>
                    </select>
                    <small class="error-message"></small>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Giá <span>*</span></label>
                        <input type="number" name="price" id="price" min="0" value="<?= $product['price'] ?>" placeholder="Nhập giá">
                        <small class="error-message"></small>
                    </div>

                    <div class="form-group">
                        <label for="stock">Tồn kho <span>*</span></label>
                        <input type="number" name="stock" id="stock" min="0" value="<?= $product['stock'] ?>" placeholder="Số lượng">
                        <small class="error-message"></small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái <span>*</span></label>
                    <select name="status" id="status">
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="Đang bán" <?= $product['status'] === 'Đang bán' ? 'selected' : '' ?>>Đang bán</option>
                        <option value="Sắp hết" <?= $product['status'] === 'Sắp hết' ? 'selected' : '' ?>>Sắp hết</option>
                        <option value="Hết hàng" <?= $product['status'] === 'Hết hàng' ? 'selected' : '' ?>>Hết hàng</option>
                    </select>
                    <small class="error-message"></small>
                </div>
            </div>

            <div class="form-right">
                <label for="image" class="upload-box <?= !empty($product['image']) ? 'has-image' : '' ?>" id="uploadBox">
                    <input type="file" name="image" id="image" accept="image/*">

                    <div class="upload-content" id="uploadContent">
                        <i class='bx bx-image-add'></i>
                        <h3>Đổi ảnh sản phẩm</h3>
                        <p>Chọn file JPG, PNG, WEBP</p>
                    </div>

                    <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" id="previewImage">
                </label>

                <small class="error-message image-error"></small>
                <p class="image-note">Không chọn ảnh mới thì giữ nguyên ảnh hiện tại.</p>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class='bx bx-save'></i>
                Cập nhật
            </button>

            <a href="index.php?act=products" class="btn-secondary">
                Hủy bỏ
            </a>
        </div>
    </form>
</div>