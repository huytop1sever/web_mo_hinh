document.addEventListener('DOMContentLoaded', function () {
    const postForm = document.getElementById('postForm');
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    if (!postForm || !titleInput || !slugInput) return;

    function slugify(value) {
        return value.toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
    }

    titleInput.addEventListener('input', function () {
        if (slugInput.dataset.touched === '1') return;
        slugInput.value = slugify(titleInput.value);
    });

    slugInput.addEventListener('input', function () {
        slugInput.dataset.touched = '1';
        slugInput.value = slugify(slugInput.value);
    });

    function setPostError(input, message) {
        const formGroup = input.closest('.form-group');
        if (!formGroup) return;

        formGroup.classList.add('error');

        const errorMessage = formGroup.querySelector('.error-message');
        if (errorMessage) {
            errorMessage.innerText = message;
        }
    }

    function clearPostError(input) {
        const formGroup = input.closest('.form-group');
        if (!formGroup) return;

        formGroup.classList.remove('error');

        const message = formGroup.querySelector('.error-message');
        if (message) {
            message.innerText = '';
        }
    }

    postForm.addEventListener('submit', function (e) {
        let isValid = true;

        const requiredFields = [
            [document.getElementById('title'), 'Vui lòng nhập tiêu đề bài viết'],
            [document.getElementById('excerpt'), 'Vui lòng nhập mô tả ngắn'],
            [document.getElementById('content'), 'Vui lòng nhập nội dung bài viết'],
            [document.getElementById('category'), 'Vui lòng chọn danh mục'],
            [document.getElementById('author'), 'Vui lòng nhập tác giả'],
            [document.getElementById('status'), 'Vui lòng chọn trạng thái']
        ];

        requiredFields.forEach(function (field) {
            const input = field[0];
            const message = field[1];

            if (!input) return;

            clearPostError(input);

            if (input.value.trim() === '') {
                setPostError(input, message);
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault();
        }
    });
});