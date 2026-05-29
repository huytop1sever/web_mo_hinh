<?php
$category = $category ?? [
    'id' => '',
    'name' => '',
    'description' => '',
    'status' => 'Hiển thị'
];
?>

<div class="box form-box category-form-box">
    <div class="box-title">
        <div>
            <h2>Chỉnh sửa danh mục</h2>
            <p>Cập nhật thông tin danh mục sản phẩm</p>
        </div>
    </div>

    <form action="index.php?page=category-update" method="POST" class="form-container category-form" id="categoryForm">
        <input type="hidden" name="id" value="<?= $category['id'] ?>">

        <div class="form-group">
            <label for="name">Tên danh mục <span>*</span></label>
            <input type="text" name="name" id="name" value="<?= $category['name'] ?>" placeholder="Nhập tên danh mục...">
            <small class="error-message"></small>
        </div>

        <div class="form-group">
            <label for="description">Mô tả <span>*</span></label>
            <textarea name="description" id="description" rows="5" placeholder="Mô tả ngắn về danh mục..."><?= $category['description'] ?></textarea>
            <small class="error-message"></small>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái <span>*</span></label>
            <select name="status" id="status">
                <option value="">-- Chọn trạng thái --</option>
                <option value="Hiển thị" <?= $category['status'] === 'Hiển thị' ? 'selected' : '' ?>>Hiển thị</option>
                <option value="Tạm ẩn" <?= $category['status'] === 'Tạm ẩn' ? 'selected' : '' ?>>Tạm ẩn</option>
            </select>
            <small class="error-message"></small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class='bx bx-save'></i>
                Cập nhật
            </button>

            <a href="index.php?page=categories" class="btn-secondary">Hủy bỏ</a>
        </div>
    </form>
</div>