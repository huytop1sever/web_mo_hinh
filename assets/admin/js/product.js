document.addEventListener('DOMContentLoaded', function () {
    const productForm = document.getElementById('productForm');

    if (!productForm) {
        return;
    }

    const imageInput = document.getElementById('image');
    const previewImage = document.getElementById('previewImage');
    const uploadBox = document.getElementById('uploadBox');
    const imageError = document.querySelector('.image-error');

    function setError(input, message) {
        if (!input) {
            return;
        }

        const formGroup = input.closest('.form-group');

        if (!formGroup) {
            return;
        }

        formGroup.classList.add('error');

        const errorMessage = formGroup.querySelector('.error-message');

        if (errorMessage) {
            errorMessage.innerText = message;
        }
    }

    function clearError(input) {
        if (!input) {
            return;
        }

        const formGroup = input.closest('.form-group');

        if (!formGroup) {
            return;
        }

        formGroup.classList.remove('error');

        const errorMessage = formGroup.querySelector('.error-message');

        if (errorMessage) {
            errorMessage.innerText = '';
        }
    }

    if (imageInput && previewImage && uploadBox) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];

            if (imageError) {
                imageError.innerText = '';
            }

            if (!file) {
                previewImage.src = '';
                uploadBox.classList.remove('has-image');
                return;
            }

            const validTypes = [
                'image/jpeg',
                'image/png',
                'image/webp',
                'image/jpg'
            ];

            if (!validTypes.includes(file.type)) {
                if (imageError) {
                    imageError.innerText = 'Ảnh phải là JPG, PNG hoặc WEBP';
                }

                this.value = '';
                previewImage.src = '';
                uploadBox.classList.remove('has-image');
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                if (imageError) {
                    imageError.innerText = 'Ảnh không được vượt quá 2MB';
                }

                this.value = '';
                previewImage.src = '';
                uploadBox.classList.remove('has-image');
                return;
            }

            previewImage.src = URL.createObjectURL(file);
            uploadBox.classList.add('has-image');
        });
    }

    productForm.addEventListener('submit', function (e) {
        let isValid = true;

        const title = document.getElementById('title');
        const category = document.getElementById('category_id');
        const description = document.getElementById('description');
        const content = document.getElementById('content');

        [title, category, description, content].forEach(function (input) {
            clearError(input);
        });

        if (imageError) {
            imageError.innerText = '';
        }

        if (title && title.value.trim() === '') {
            setError(title, 'Vui lòng nhập tên sản phẩm');
            isValid = false;
        }

        if (category && category.value === '') {
            setError(category, 'Vui lòng chọn danh mục');
            isValid = false;
        }

        if (description && description.value.trim() === '') {
            setError(description, 'Vui lòng nhập mô tả sản phẩm');
            isValid = false;
        }

        if (content && content.value.trim() === '') {
            setError(content, 'Vui lòng nhập nội dung chi tiết');
            isValid = false;
        }

        const isCreatePage = productForm.dataset.mode === 'create';

        if (
            isCreatePage &&
            imageInput &&
            imageInput.files.length === 0 &&
            imageError
        ) {
            imageError.innerText = 'Vui lòng chọn ảnh sản phẩm';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});