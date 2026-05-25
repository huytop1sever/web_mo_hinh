<?php $postEdit = $postEdit ?? []; ?>

<div class="posts-page">

    <div class="box">

        <div class="box-title">
            <h2>Sửa bài viết</h2>

            <a href="index.php?page=posts" class="btn-primary">
                <i class='bx bx-arrow-back'></i>
                <span>Quay lại</span>
            </a>
        </div>

        <form action="index.php?page=posts" method="post" class="post-form">

            <input type="hidden" name="id" value="<?= $postEdit['id'] ?>">

            <div class="form-group">
                <label>Tiêu đề bài viết</label>
                <input type="text" name="title" value="<?= $postEdit['title'] ?>">
            </div>

            <div class="form-group">
                <label>Danh mục</label>
                <select name="category">
                    <option <?= $postEdit['category'] === 'Gundam' ? 'selected' : '' ?>>Gundam</option>
                    <option <?= $postEdit['category'] === 'Anime Figure' ? 'selected' : '' ?>>Anime Figure</option>
                    <option <?= $postEdit['category'] === 'Hướng dẫn' ? 'selected' : '' ?>>Hướng dẫn</option>
                    <option <?= $postEdit['category'] === 'Tin tức' ? 'selected' : '' ?>>Tin tức</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tác giả</label>
                <input type="text" name="author" value="<?= $postEdit['author'] ?>">
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status">
                    <option <?= $postEdit['status'] === 'Hiển thị' ? 'selected' : '' ?>>Hiển thị</option>
                    <option <?= $postEdit['status'] === 'Ẩn' ? 'selected' : '' ?>>Ẩn</option>
                </select>
            </div>

            <div class="form-group full">
                <label>Nội dung</label>
                <textarea name="content"><?= $postEdit['content'] ?? '' ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class='bx bx-save'></i>
                    <span>Cập nhật bài viết</span>
                </button>
            </div>

        </form>

    </div>

</div>