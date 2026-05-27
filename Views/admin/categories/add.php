<div class="box form-box">
    <div class="box-title">
        <h2>Thêm danh mục mới</h2>
    </div>

    <form action="index.php?act=category-store" method="POST" class="form-container">
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" name="name" id="name" placeholder="Nhập tên danh mục..." required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" id="description" rows="5" placeholder="Mô tả ngắn về danh mục..."></textarea>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" id="status">
                <option value="Hiển thị">Hiển thị</option>
                <option value="Tạm ẩn">Tạm ẩn</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Lưu danh mục</button>
            <a href="index.php?act=categories" class="btn-secondary">Hủy bỏ</a>
        </div>
    </form>
</div>
