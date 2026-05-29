<div class="posts-page">

    <div class="box post-form-box">

        <div class="box-title">
            <div>
                <h2>Thêm bài viết</h2>
                <p>Nhập thông tin bài viết cho website mô hình</p>
            </div>

            <a href="index.php?page=posts" class="btn-primary">
                <i class='bx bx-arrow-back'></i>
                <span>Quay lại</span>
            </a>
        </div>

        <form action="index.php?page=posts" method="post" class="post-form" id="postForm">

            <div class="form-group">
                <label for="title">Tiêu đề bài viết <span>*</span></label>
                <input type="text" name="title" id="title" placeholder="Nhập tiêu đề bài viết">
                <small class="error-message"></small>
            </div>

            <div class="form-group">
                <label for="category">Danh mục <span>*</span></label>
                <select name="category" id="category">
                    <option value="">-- Chọn danh mục --</option>
                    <option value="Gundam">Gundam</option>
                    <option value="Anime Figure">Anime Figure</option>
                    <option value="Hướng dẫn">Hướng dẫn</option>
                    <option value="Tin tức">Tin tức</option>
                </select>
                <small class="error-message"></small>
            </div>

            <div class="form-group">
                <label for="author">Tác giả <span>*</span></label>
                <input type="text" name="author" id="author" value="Admin" placeholder="Nhập tên tác giả">
                <small class="error-message"></small>
            </div>

            <div class="form-group">
                <label for="status">Trạng thái <span>*</span></label>
                <select name="status" id="status">
                    <option value="">-- Chọn trạng thái --</option>
                    <option value="Hiển thị">Hiển thị</option>
                    <option value="Ẩn">Ẩn</option>
                </select>
                <small class="error-message"></small>
            </div>

            <div class="form-group full">
                <label for="content">Nội dung <span>*</span></label>
                <textarea name="content" id="content" placeholder="Nhập nội dung bài viết"></textarea>
                <small class="error-message"></small>
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

<script>
const postForm = document.getElementById('postForm');

function setPostError(input, message) {
    const formGroup = input.closest('.form-group');
    formGroup.classList.add('error');
    formGroup.querySelector('.error-message').innerText = message;
}

function clearPostError(input) {
    const formGroup = input.closest('.form-group');
    formGroup.classList.remove('error');
    formGroup.querySelector('.error-message').innerText = '';
}

postForm.addEventListener('submit', function (e) {
    let isValid = true;

    const title = document.getElementById('title');
    const category = document.getElementById('category');
    const author = document.getElementById('author');
    const status = document.getElementById('status');
    const content = document.getElementById('content');

    [title, category, author, status, content].forEach(clearPostError);

    if (title.value.trim() === '') {
        setPostError(title, 'Vui lòng nhập tiêu đề bài viết');
        isValid = false;
    }

    if (category.value === '') {
        setPostError(category, 'Vui lòng chọn danh mục');
        isValid = false;
    }

    if (author.value.trim() === '') {
        setPostError(author, 'Vui lòng nhập tác giả');
        isValid = false;
    }

    if (status.value === '') {
        setPostError(status, 'Vui lòng chọn trạng thái');
        isValid = false;
    }

    if (content.value.trim() === '') {
        setPostError(content, 'Vui lòng nhập nội dung bài viết');
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
    }
});
</script>