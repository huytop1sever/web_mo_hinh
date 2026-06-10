<?php
$categories = $categories ?? [];
$statusText = $statusText ?? [];
?>

<div class="posts-page">
    <div class="box post-form-box">
        <div class="box-title">
            <div>
                <h2>Th&#234;m b&#224;i vi&#7871;t</h2>
                <p>So&#7841;n n&#7897;i dung, t&#7889;i &#432;u slug v&#224; thi&#7871;t l&#7853;p tr&#7841;ng th&#225;i xu&#7845;t b&#7843;n.</p>
            </div>

            <a href="index.php?page=posts" class="btn-secondary">
                <i class='bx bx-arrow-back'></i>
                <span>Quay l&#7841;i</span>
            </a>
        </div>

        <form action="index.php?page=post-store" method="post" enctype="multipart/form-data" class="post-editor-form" id="postForm">
            <div class="post-editor-main">
                <div class="form-group full">
                    <label for="title">Ti&#234;u &#273;&#7873; b&#224;i vi&#7871;t <span>*</span></label>
                    <input type="text" name="title" id="title" placeholder="VD: 5 m&#7851;u Gundam MG &#273;&#225;ng mua trong th&#225;ng n&#224;y">
                    <small class="field-hint">Ti&#234;u &#273;&#7873; r&#245;, c&#243; t&#7915; kh&#243;a ch&#237;nh v&#224; kh&#244;ng qu&#225; d&#224;i.</small>
                    <small class="error-message"></small>
                </div>

                <div class="form-group full">
                    <label for="slug">Slug URL</label>
                    <input type="text" name="slug" id="slug" placeholder="5-mau-gundam-mg-dang-mua">
                    <small class="field-hint">Slug s&#7869; t&#7921; t&#7841;o t&#7915; ti&#234;u &#273;&#7873;, b&#7841;n c&#243; th&#7875; ch&#7881;nh l&#7841;i.</small>
                </div>

                <div class="form-group full">
                    <label for="excerpt">M&#244; t&#7843; ng&#7855;n <span>*</span></label>
                    <textarea name="excerpt" id="excerpt" class="excerpt-input" placeholder="T&#243;m t&#7855;t 1-2 c&#226;u hi&#7875;n th&#7883; trong danh s&#225;ch b&#224;i vi&#7871;t."></textarea>
                    <small class="error-message"></small>
                </div>

                <div class="editor-toolbar" aria-hidden="true">
                    <button type="button" title="In dam"><i class='bx bx-bold'></i></button>
                    <button type="button" title="In nghieng"><i class='bx bx-italic'></i></button>
                    <button type="button" title="Danh sach"><i class='bx bx-list-ul'></i></button>
                    <button type="button" title="Chen link"><i class='bx bx-link'></i></button>
                    <button type="button" title="Chen anh"><i class='bx bx-image-add'></i></button>
                </div>

                <div class="form-group full">
                    <label for="content">N&#7897;i dung <span>*</span></label>
                    <textarea name="content" id="content" class="content-input" placeholder="Nh&#7853;p n&#7897;i dung chi ti&#7871;t b&#224;i vi&#7871;t..."></textarea>
                    <small class="error-message"></small>
                </div>
            </div>

            <aside class="post-editor-side">
                <div class="publish-panel">
                    <h3>Xu&#7845;t b&#7843;n</h3>

                    <div class="form-group">
                        <label for="category">Danh m&#7909;c <span>*</span></label>
                        <select name="category" id="category">
                            <option value="">Ch&#7885;n danh m&#7909;c</option>
                            <?php foreach ($categories as $item): ?>
                                <option value="<?= htmlspecialchars($item) ?>"><?= htmlspecialchars($item) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>

                    <div class="form-group">
                        <label for="author">T&#225;c gi&#7843; <span>*</span></label>
                        <input type="text" name="author" id="author" value="Admin" placeholder="T&#234;n t&#225;c gi&#7843;">
                        <small class="error-message"></small>
                    </div>

                    <div class="form-group">
                        <label for="date">Ng&#224;y &#273;&#259;ng</label>
                        <input type="date" name="date" id="date" value="<?= date('Y-m-d') ?>">
                    </div>

                    <div class="form-group">
                        <label for="status">Tr&#7841;ng th&#225;i <span>*</span></label>
                        <select name="status" id="status">
                            <?php foreach ($statusText as $key => $text): ?>
                                <option value="<?= htmlspecialchars($key) ?>" <?= $key === 'draft' ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($text) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>

                    <label class="toggle-row">
                        <input type="checkbox" name="featured" value="1">
                        <span></span>
                        B&#224;i n&#7893;i b&#7853;t
                    </label>
                </div>

                <div class="publish-panel">
                    <h3>&#7842;nh &#273;&#7841;i di&#7879;n</h3>
                    <label class="image-drop" for="image">
                        <i class='bx bx-cloud-upload'></i>
                        <strong>T&#7843;i &#7843;nh l&#234;n</strong>
                        <span>PNG, JPG ho&#7863;c WEBP</span>
                    </label>
                    <input type="file" name="image" id="image" accept="image/*" class="file-input">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class='bx bx-save'></i>
                        <span>L&#432;u b&#224;i vi&#7871;t</span>
                    </button>
                </div>
            </aside>
        </form>
    </div>
</div>

<script>
const postForm = document.getElementById('postForm');
const titleInput = document.getElementById('title');
const slugInput = document.getElementById('slug');

function slugify(value) {
    return value.toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '');
}

titleInput.addEventListener('input', function () {
    if (slugInput.dataset.touched === '1') {
        return;
    }

    slugInput.value = slugify(titleInput.value);
});

slugInput.addEventListener('input', function () {
    slugInput.dataset.touched = '1';
    slugInput.value = slugify(slugInput.value);
});

function setPostError(input, message) {
    const formGroup = input.closest('.form-group');
    formGroup.classList.add('error');
    formGroup.querySelector('.error-message').innerText = message;
}

function clearPostError(input) {
    const formGroup = input.closest('.form-group');
    formGroup.classList.remove('error');
    const message = formGroup.querySelector('.error-message');
    if (message) {
        message.innerText = '';
    }
}

postForm.addEventListener('submit', function (e) {
    let isValid = true;
    const requiredFields = [
        [document.getElementById('title'), 'Vui long nhap tieu de bai viet'],
        [document.getElementById('excerpt'), 'Vui long nhap mo ta ngan'],
        [document.getElementById('content'), 'Vui long nhap noi dung bai viet'],
        [document.getElementById('category'), 'Vui long chon danh muc'],
        [document.getElementById('author'), 'Vui long nhap tac gia'],
        [document.getElementById('status'), 'Vui long chon trang thai']
    ];

    requiredFields.forEach(function (field) {
        clearPostError(field[0]);
        if (field[0].value.trim() === '') {
            setPostError(field[0], field[1]);
            isValid = false;
        }
    });

    if (!isValid) {
        e.preventDefault();
    }
});
</script>
