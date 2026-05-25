<div class="posts-page">

    <div class="box">

        <div class="box-title">
            <h2>Thêm bài viết</h2>

            <a href="index.php?page=posts" class="btn-primary">
                <i class='bx bx-arrow-back'></i>
                <span>Quay lại</span>
            </a>
        </div>

        <form action="index.php?page=posts" method="post" class="post-form">

            <div class="form-group">
                <label>Tiêu đề bài viết</label>
                <input type="text" name="title" placeholder="Nhập tiêu đề bài viết">
            </div>

            <div class="form-group">
                <label>Danh mục</label>
                <select name="category">
                    <option>Gundam</option>
                    <option>Anime Figure</option>
                    <option>Hướng dẫn</option>
                    <option>Tin tức</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tác giả</label>
                <input type="text" name="author" value="Admin">
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status">
                    <option>Hiển thị</option>
                    <option>Ẩn</option>
                </select>
            </div>

            <div class="form-group full">
                <label>Nội dung</label>
                <textarea name="content" placeholder="Nhập nội dung bài viết"></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class='bx bx-save'></i>
                    <span>Lưu bài viết</span>
                </button>
            </div>

        </form>

    </div>

</div>