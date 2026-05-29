const categoryForm = document.getElementById('categoryForm');

function setCategoryError(input, message) {
    const formGroup = input.closest('.form-group');
    formGroup.classList.add('error');
    formGroup.querySelector('.error-message').innerText = message;
}

function clearCategoryError(input) {
    const formGroup = input.closest('.form-group');
    formGroup.classList.remove('error');
    formGroup.querySelector('.error-message').innerText = '';
}

categoryForm.addEventListener('submit', function (e) {
    let isValid = true;

    const name = document.getElementById('name');
    const description = document.getElementById('description');
    const status = document.getElementById('status');

    [name, description, status].forEach(clearCategoryError);

    if (name.value.trim() === '') {
        setCategoryError(name, 'Vui lòng nhập tên danh mục');
        isValid = false;
    }

    if (description.value.trim() === '') {
        setCategoryError(description, 'Vui lòng nhập mô tả danh mục');
        isValid = false;
    }

    if (status.value === '') {
        setCategoryError(status, 'Vui lòng chọn trạng thái');
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
    }
});