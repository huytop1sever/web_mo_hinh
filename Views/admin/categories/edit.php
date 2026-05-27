<?php
$category = $category ?? ['id' => '', 'name' => '', 'description' => '', 'status' => 'Hiển thị'];
?>
<div class="box form-box">
    <div class="box-title">
        <h2>Chỉnh sửa danh mục: <?= $category['name'] ?></h2>
    </div>

    <form action="index.php?act=category-update" method="POST" class="form-container">
        <input type="hidden" name="id" value="<?= $category['id'] ?>">
        
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" name="name" id="name" value="<?= $category['name'] ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" id="description" rows="5"><?= $category['description'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" id="status">
                <option value="Hiển thị" <?= $category['status'] === 'Hiển thị' ? 'selected' : '' ?>>Hiển thị</option>
                <option value="Tạm ẩn" <?= $category['status'] === 'Tạm ẩn' ? 'selected' : '' ?>>Tạm ẩn</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Cập nhật</button>
            <a href="index.php?act=categories" class="btn-secondary">Hủy bỏ</a>
        </div>
    </form>
</div>
