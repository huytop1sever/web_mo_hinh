<?php
$postEdit = $postEdit ?? [];
$categories = $categories ?? [];
$statusText = $statusText ?? [];

$image = $postEdit['image'] ?? '';

if (!empty($image)) {
    if (
        !str_contains($image, 'uploads/')
        && !str_contains($image, 'assets/')
        && !str_contains($image, 'http')
    ) {
        $image = 'uploads/posts/' . $image;
    }

    $imageSrc = str_contains($image, 'http') ? $image : '../' . $image;
} else {
    $imageSrc = '';
}
?>

<div class="posts-page">
    <div class="box post-form-box">
        <div class="box-title">
            <div>
                <h2>Sửa bài viết</h2>
                <p>Cập nhật nội dung, slug, ảnh đại diện và trạng thái xuất bản.</p>
            </div>

            <a href="index.php?page=posts" class="btn-secondary">
                <i class='bx bx-arrow-back'></i>
                <span>Quay lại</span>
            </a>
        </div>

        <form action="index.php?page=post-update" method="post" enctype="multipart/form-data" class="post-editor-form" id="postForm">
            <input type="hidden" name="id" value="<?= htmlspecialchars($postEdit['id'] ?? '') ?>">

            <div class="post-editor-main">
                <div class="form-group full">
                    <label for="title">Tiêu đề bài viết <span>*</span></label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="<?= htmlspecialchars($postEdit['title'] ?? '') ?>"
                        placeholder="VD: 5 mẫu Gundam MG đáng mua trong tháng này">
                    <small class="field-hint">Tiêu đề rõ, có từ khóa chính và không quá dài.</small>
                    <small class="error-message"></small>
                </div>

                <div class="form-group full">
                    <label for="slug">Slug URL</label>
                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        value="<?= htmlspecialchars($postEdit['slug'] ?? '') ?>"
                        data-touched="1"
                        placeholder="5-mau-gundam-mg-dang-mua">
                    <small class="field-hint">Slug nên ngắn, dễ đọc và không trùng bài khác.</small>
                </div>

                <div class="form-group full">
                    <label for="excerpt">Mô tả ngắn <span>*</span></label>
                    <textarea name="excerpt" id="excerpt" class="excerpt-input" placeholder="Tóm tắt 1-2 câu hiển thị trong danh sách bài viết."><?= htmlspecialchars($postEdit['excerpt'] ?? '') ?></textarea>
                    <small class="error-message"></small>
                </div>

                <div class="editor-toolbar" aria-hidden="true">
                    <button type="button" title="In đậm"><i class='bx bx-bold'></i></button>
                    <button type="button" title="In nghiêng"><i class='bx bx-italic'></i></button>
                    <button type="button" title="Danh sách"><i class='bx bx-list-ul'></i></button>
                    <button type="button" title="Chèn link"><i class='bx bx-link'></i></button>
                    <button type="button" title="Chèn ảnh"><i class='bx bx-image-add'></i></button>
                </div>

                <div class="form-group full">
                    <label for="content">Nội dung <span>*</span></label>
                    <textarea name="content" id="content" class="content-input" placeholder="Nhập nội dung chi tiết bài viết..."><?= htmlspecialchars($postEdit['content'] ?? '') ?></textarea>
                    <small class="error-message"></small>
                </div>
            </div>

            <aside class="post-editor-side">
                <div class="publish-panel">
                    <h3>Xuất bản</h3>

                    <div class="form-group">
                        <label for="category">Danh mục <span>*</span></label>
                        <select name="category" id="category">
                            <option value="">Chọn danh mục</option>

                            <?php foreach ($categories as $item): ?>
                                <?php $categoryName = is_array($item) ? ($item['name'] ?? '') : $item; ?>

                                <option
                                    value="<?= htmlspecialchars($categoryName) ?>"
                                    <?= ($postEdit['category'] ?? '') === $categoryName ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($categoryName) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>

                    <div class="form-group">
                        <label for="author">Tác giả <span>*</span></label>
                        <input
                            type="text"
                            name="author"
                            id="author"
                            value="<?= htmlspecialchars($postEdit['author'] ?? 'Admin') ?>"
                            placeholder="Tên tác giả">
                        <small class="error-message"></small>
                    </div>

                    <div class="form-group">
                        <label for="date">Ngày đăng</label>
                        <input
                            type="date"
                            name="date"
                            id="date"
                            value="<?= htmlspecialchars($postEdit['date'] ?? date('Y-m-d')) ?>">
                    </div>

                    <div class="form-group">
                        <label for="status">Trạng thái <span>*</span></label>
                        <select name="status" id="status">
                            <?php foreach ($statusText as $key => $text): ?>
                                <option
                                    value="<?= htmlspecialchars($key) ?>"
                                    <?= ($postEdit['status'] ?? '') === $key ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($text) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>

                    <label class="toggle-row">
                        <input type="checkbox" name="featured" value="1" <?= !empty($postEdit['featured']) ? 'checked' : '' ?>>
                        <span></span>
                        Bài nổi bật
                    </label>
                </div>

                <div class="publish-panel">
                    <h3>Ảnh đại diện</h3>

                    <?php if (!empty($imageSrc)): ?>
                        <img
                            src="<?= htmlspecialchars($imageSrc) ?>"
                            alt="<?= htmlspecialchars($postEdit['title'] ?? '') ?>"
                            class="current-post-image">
                    <?php endif; ?>

                    <label class="image-drop" for="image">
                        <i class='bx bx-cloud-upload'></i>
                        <strong>Thay ảnh</strong>
                        <span>PNG, JPG hoặc WEBP</span>
                    </label>

                    <input type="file" name="image" id="image" accept="image/*" class="file-input">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class='bx bx-save'></i>
                        <span>Cập nhật</span>
                    </button>
                </div>
            </aside>
        </form>
    </div>
</div>

<script src="../assets/admin/js/post-form.js"></script>