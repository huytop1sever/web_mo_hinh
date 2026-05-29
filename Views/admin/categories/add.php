<div class="box form-box category-form-box">
    <div class="box-title">
        <div>
            <h2>Thêm danh mục mới</h2>
            <p>Nhập thông tin danh mục sản phẩm</p>
        </div>
    </div>

    <form action="index.php?page=category-store" method="POST" class="form-container category-form" id="categoryForm">
        <div class="form-group">
            <label for="name">Tên danh mục <span>*</span></label>
            <input type="text" name="name" id="name" placeholder="Nhập tên danh mục...">
            <small class="error-message"></small>
        </div>

        <div class="form-group">
            <label for="description">Mô tả <span>*</span></label>
            <textarea name="description" id="description" rows="5" placeholder="Mô tả ngắn về danh mục..."></textarea>
            <small class="error-message"></small>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái <span>*</span></label>
            <select name="status" id="status">
                <option value="">-- Chọn trạng thái --</option>
                <option value="Hiển thị">Hiển thị</option>
                <option value="Tạm ẩn">Tạm ẩn</option>
            </select>
            <small class="error-message"></small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class='bx bx-save'></i>
                Lưu danh mục
            </button>

            <a href="index.php?page=categories" class="btn-secondary">Hủy bỏ</a>
        </div>
    </form>
</div>