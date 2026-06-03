document.addEventListener('DOMContentLoaded', function () {
    const categoryForm = document.getElementById('categoryForm');

    if (!categoryForm) {
        return;
    }

    function setCategoryError(input, message) {
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

    function clearCategoryError(input) {
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

    categoryForm.addEventListener('submit', function (e) {
        let isValid = true;

        const name = document.getElementById('name');
        const description = document.getElementById('description');
        const status = document.getElementById('status');

        const inputs = [name, description, status];

        inputs.forEach(function (input) {
            if (input) {
                clearCategoryError(input);
            }
        });

        if (name && name.value.trim() === '') {
            setCategoryError(name, 'Vui lòng nhập tên danh mục');
            isValid = false;
        }

        if (description && description.value.trim() === '') {
            setCategoryError(description, 'Vui lòng nhập mô tả danh mục');
            isValid = false;
        }

        if (status && status.value === '') {
            setCategoryError(status, 'Vui lòng chọn trạng thái');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});