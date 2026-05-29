document.addEventListener('DOMContentLoaded', function () {
    const productForm = document.getElementById('productForm');
    if (!productForm) return;

    const imageInput = document.getElementById('image');
    const previewImage = document.getElementById('previewImage');
    const uploadBox = document.getElementById('uploadBox');
    const imageError = document.querySelector('.image-error');

    function setError(input, message) {
        const formGroup = input.closest('.form-group');

        if (formGroup) {
            formGroup.classList.add('error');
            formGroup.querySelector('.error-message').innerText = message;
        }
    }

    function clearError(input) {
        const formGroup = input.closest('.form-group');

        if (formGroup) {
            formGroup.classList.remove('error');
            formGroup.querySelector('.error-message').innerText = '';
        }
    }

    if (imageInput) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            imageError.innerText = '';

            if (!file) {
                previewImage.src = '';
                uploadBox.classList.remove('has-image');
                return;
            }

            const validTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];

            if (!validTypes.includes(file.type)) {
                imageError.innerText = 'Ảnh phải là JPG, PNG hoặc WEBP';
                this.value = '';
                uploadBox.classList.remove('has-image');
                previewImage.src = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                imageError.innerText = 'Ảnh không được vượt quá 2MB';
                this.value = '';
                uploadBox.classList.remove('has-image');
                previewImage.src = '';
                return;
            }

            previewImage.src = URL.createObjectURL(file);
            uploadBox.classList.add('has-image');
        });
    }

    productForm.addEventListener('submit', function (e) {
        let isValid = true;

        const name = document.getElementById('name');
        const category = document.getElementById('category');
        const price = document.getElementById('price');
        const stock = document.getElementById('stock');
        const status = document.getElementById('status');

        [name, category, price, stock, status].forEach(clearError);

        if (imageError) {
            imageError.innerText = '';
        }

        if (name.value.trim() === '') {
            setError(name, 'Vui lòng nhập tên sản phẩm');
            isValid = false;
        }

        if (category.value === '') {
            setError(category, 'Vui lòng chọn danh mục');
            isValid = false;
        }

        if (price.value === '' || Number(price.value) < 0) {
            setError(price, 'Giá phải lớn hơn hoặc bằng 0');
            isValid = false;
        }

        if (stock.value === '' || Number(stock.value) < 0) {
            setError(stock, 'Tồn kho phải lớn hơn hoặc bằng 0');
            isValid = false;
        }

        if (status.value === '') {
            setError(status, 'Vui lòng chọn trạng thái');
            isValid = false;
        }

        const isCreatePage = productForm.dataset.mode === 'create';

        if (isCreatePage && imageInput && imageInput.files.length === 0) {
            imageError.innerText = 'Vui lòng chọn ảnh sản phẩm';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});