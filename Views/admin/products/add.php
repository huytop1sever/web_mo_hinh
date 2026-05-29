<div class="box form-box product-form-box">
    <div class="box-title">
        <div>
            <h2>Thêm sản phẩm mới</h2>
            <p>Nhập thông tin sản phẩm mô hình</p>
        </div>
    </div>

    <form action="index.php?page=product-store" method="POST" enctype="multipart/form-data" class="form-container" id="productForm" data-mode="create">
        <div class="form-grid">
            <div class="form-left">
                <div class="form-group">
                    <label for="name">Tên sản phẩm <span>*</span></label>
                    <input type="text" name="name" id="name" placeholder="VD: Luffy Gear 5 Figure">
                    <small class="error-message"></small>
                </div>

                <div class="form-group">
                    <label for="category">Danh mục <span>*</span></label>
                    <select name="category" id="category">
                        <option value="">-- Chọn danh mục --</option>
                        <option value="Gundam">Gundam</option>
                        <option value="Anime Figure">Anime Figure</option>
                        <option value="Marvel">Marvel</option>
                        <option value="Pokemon">Pokemon</option>
                    </select>
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
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái <span>*</span></label>
                    <select name="status" id="status">
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="Đang bán">Đang bán</option>
                        <option value="Sắp hết">Sắp hết</option>
                        <option value="Hết hàng">Hết hàng</option>
                    </select>
                    <small class="error-message"></small>
                </div>
            </div>

            <div class="form-right">
                <label for="image" class="upload-box" id="uploadBox">
                    <input type="file" name="image" id="image" accept="image/*">

                    <div class="upload-content" id="uploadContent">
                        <i class='bx bx-image-add'></i>
                        <h3>Thêm ảnh sản phẩm</h3>
                        <p>Chọn file JPG, PNG, WEBP</p>
                    </div>

                    <img src="" alt="Preview" id="previewImage">
                </label>

                <small class="error-message image-error"></small>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class='bx bx-save'></i>
                Lưu sản phẩm
            </button>

            <a href="index.php?act=products" class="btn-secondary">
                Hủy bỏ
            </a>
        </div>
    </form>
</div>