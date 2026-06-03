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

<<<<<<< HEAD
                <div class="form-group">
                    <label>Danh mục</label>
                    <select name="category_id" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>">
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
<<<<<<< HEAD
=======
                    <small class="error-message"></small>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea name="description" id="description" rows="5" placeholder="Nhập mô tả chi tiết sản phẩm..."></textarea>
                    <small class="error-message"></small>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Giá <span>*</span></label>
                        <input type="number" name="price" id="price" min="0" placeholder="Nhập giá">
                        <small class="error-message"></small>
                    </div>

                    <div class="form-group">
                        <label for="stock">Tồn kho <span>*</span></label>
                        <input type="number" name="stock" id="stock" min="0" placeholder="Số lượng">
                        <small class="error-message"></small>
                    </div>
>>>>>>> db531e74fedf0048d3cf07ab08e028f6e8dddbae
                </div>

                <div class="form-group">
                    <label>Mô tả ngắn</label>
                    <textarea name="description" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label>Nội dung chi tiết</label>
                    <textarea name="content" rows="6"></textarea>
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
            </div>

            <div class="form-right">
                <label class="upload-box">
                    <input type="file" name="image" accept="image/*" onchange="previewImage(this, 'mainPreview')">
                    <i class='bx bx-cloud-upload'></i>
                    <span>Chọn ảnh sản phẩm</span>
                    <small>Ảnh sẽ lưu vào thư mục uploads/products</small>
                </label>

                <img id="mainPreview" class="image-preview" src="" alt="">
            </div>
        </div>

        <div class="variant-section">
            <div class="variant-title">
                <h3>Biến thể sản phẩm</h3>
                <button type="button" class="btn-secondary" onclick="addVariant()">+ Thêm biến thể</button>
            </div>

            <div id="variant-list">
                <div class="variant-card">
                    <div class="variant-fields">
                        <input type="text" name="variant_name[]" placeholder="Tên biến thể VD: Size 20cm" required>
                        <input type="text" name="sku[]" placeholder="SKU">
                        <input type="number" name="price[]" placeholder="Giá" required>
                        <input type="number" name="sale_price[]" placeholder="Giá sale">
                        <input type="number" name="stock[]" placeholder="Tồn kho" required>

                        <select name="variant_status[]">
                            <option value="1">Đang bán</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>

                    <label class="variant-upload">
                        <input type="file" name="variant_image[]" accept="image/*">
                        Chọn ảnh biến thể
                    </label>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class='bx bx-save'></i>
                Lưu sản phẩm
            </button>

            <a href="index.php?page=products" class="btn-secondary">
                Hủy bỏ
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(input, previewId) {
    const file = input.files[0];
    const preview = document.getElementById(previewId);

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
}

function addVariant() {
    const html = `
        <div class="variant-card">
            <div class="variant-fields">
                <input type="text" name="variant_name[]" placeholder="Tên biến thể" required>
                <input type="text" name="sku[]" placeholder="SKU">
                <input type="number" name="price[]" placeholder="Giá" required>
                <input type="number" name="sale_price[]" placeholder="Giá sale">
                <input type="number" name="stock[]" placeholder="Tồn kho" required>

                <select name="variant_status[]">
                    <option value="1">Đang bán</option>
                    <option value="0">Ẩn</option>
=======
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
>>>>>>> 1d421b2 (adminSanPham)
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
