<div class="box form-box">
    <div class="box-title">
        <h2>Them san pham moi</h2>
    </div>

    <form action="index.php?act=product-store" method="POST" class="form-container">
        <div class="form-group">
            <label for="name">Ten san pham</label>
            <input type="text" name="name" id="name" placeholder="Nhap ten san pham..." required>
        </div>

        <div class="form-group">
            <label for="category">Danh muc</label>
            <select name="category" id="category">
                <option value="Gundam">Gundam</option>
                <option value="Anime Figure">Anime Figure</option>
                <option value="Marvel">Marvel</option>
                <option value="Pokemon">Pokemon</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Gia</label>
            <input type="number" name="price" id="price" min="0" placeholder="Nhap gia san pham..." required>
        </div>

        <div class="form-group">
            <label for="stock">Ton kho</label>
            <input type="number" name="stock" id="stock" min="0" placeholder="Nhap so luong ton..." required>
        </div>

        <div class="form-group">
            <label for="status">Trang thai</label>
            <select name="status" id="status">
                <option value="Dang ban">Dang ban</option>
                <option value="Sap het">Sap het</option>
                <option value="Het hang">Het hang</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Luu san pham</button>
            <a href="index.php?act=products" class="btn-secondary">Huy bo</a>
        </div>
    </form>
</div>
