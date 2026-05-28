<div class="box form-box">
    <div class="box-title">
        <h2>Thêm sản phẩm mới</h2>
    </div>

    <form action="index.php?act=product-store" method="POST" class="form-container">
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" name="name" id="name" placeholder="Nhập tên sản phẩm..." required>
        </div>

        <div class="form-group">
            <label for="image">Link ảnh sản phẩm</label>
            <input type="text" name="image" id="image" placeholder="Nhập link ảnh sản phẩm...">
        </div>

        <div class="form-group">
            <label for="category">Danh mục</label>
            <select name="category" id="category">
                <option value="Gundam">Gundam</option>
                <option value="Anime Figure">Anime Figure</option>
                <option value="Marvel">Marvel</option>
                <option value="Pokemon">Pokemon</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" id="price" min="0" placeholder="Nhập giá sản phẩm..." required>
        </div>

        <div class="form-group">
            <label for="stock">Tồn kho</label>
            <input type="number" name="stock" id="stock" min="0" placeholder="Nhập số lượng tồn..." required>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" id="status">
                <option value="Đang bán">Đang bán</option>
                <option value="Sắp hết">Sắp hết</option>
                <option value="Hết hàng">Hết hàng</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Lưu sản phẩm</button>
            <a href="index.php?act=products" class="btn-secondary">Hủy bỏ</a>
        </div>
    </form>
</div>