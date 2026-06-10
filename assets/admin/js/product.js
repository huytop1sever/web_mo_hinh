document.addEventListener('DOMContentLoaded', function () {
    const productForm = document.getElementById('productForm');

    if (!productForm) {
        return;
    }

    const imageInput = document.getElementById('image');
    const previewImage = document.getElementById('previewImage');
    const uploadBox = document.getElementById('uploadBox');
    const imageError = document.querySelector('.image-error');
    const variantList = document.getElementById('variantList');

    let variantIndex = document.querySelectorAll('.variant-item').length;

    function setError(input, message) {
        if (!input) return;

        const formGroup = input.closest('.form-group');

        if (!formGroup) return;

        formGroup.classList.add('error');

        const errorMessage = formGroup.querySelector('.error-message');

        if (errorMessage) {
            errorMessage.innerText = message;
        }
    }

    function clearError(input) {
        if (!input) return;

        const formGroup = input.closest('.form-group');

        if (!formGroup) return;

        formGroup.classList.remove('error');

        const errorMessage = formGroup.querySelector('.error-message');

        if (errorMessage) {
            errorMessage.innerText = '';
        }
    }

    function removeVietnamese(str) {
        return str
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/đ/g, 'd')
            .replace(/Đ/g, 'D');
    }

    function makeSku(productName, variantName) {
        productName = removeVietnamese(productName.trim());
        variantName = removeVietnamese(variantName.trim());

        const initials = productName
            .split(/\s+/)
            .filter(Boolean)
            .map(word => word.charAt(0))
            .join('')
            .toUpperCase();

        const sizeMatch = variantName.match(/(\d+)/);
        const size = sizeMatch ? sizeMatch[1] : '00';

        return initials ? `${initials}-${size}` : `SP-${size}`;
    }

    function updateSkuByVariant(variantItem) {
        if (!variantItem) return;

        const productTitle = document.getElementById('title')?.value || '';
        const variantNameInput = variantItem.querySelector('input[name*="[variant_name]"]');
        const skuInput = variantItem.querySelector('input[name*="[sku]"]');

        if (!variantNameInput || !skuInput) return;

        skuInput.value = makeSku(productTitle, variantNameInput.value);
    }

    function updateAllSkus() {
        document.querySelectorAll('.variant-item').forEach(function (item) {
            updateSkuByVariant(item);
        });
    }

    function formatNumberInput(input) {
        if (!input) return;
        input.value = input.value.replace(/[^0-9]/g, '');
    }

    function clearVariantErrors() {
        document.querySelectorAll('.variant-item input, .variant-item select')
            .forEach(function (input) {
                clearError(input);
            });
    }

    function validateVariants() {
        let isValid = true;

        document.querySelectorAll('.variant-item').forEach(function (item) {
            const variantName = item.querySelector('input[name*="[variant_name]"]');
            const price = item.querySelector('input[name*="[price]"]');
            const salePrice = item.querySelector('input[name*="[sale_price]"]');
            const stock = item.querySelector('input[name*="[stock]"]');

            if (variantName && variantName.value.trim() === '') {
                setError(variantName, 'Vui lòng nhập tên biến thể');
                isValid = false;
            }

            if (price && price.value.trim() === '') {
                setError(price, 'Vui lòng nhập giá');
                isValid = false;
            }

            if (price && price.value.trim() !== '' && Number(price.value) <= 0) {
                setError(price, 'Giá phải lớn hơn 0');
                isValid = false;
            }

            if (salePrice && salePrice.value.trim() !== '' && Number(salePrice.value) <= 0) {
                setError(salePrice, 'Giá sale phải lớn hơn 0');
                isValid = false;
            }

            if (
                price &&
                salePrice &&
                price.value.trim() !== '' &&
                salePrice.value.trim() !== '' &&
                Number(salePrice.value) >= Number(price.value)
            ) {
                setError(salePrice, 'Giá sale phải nhỏ hơn giá gốc');
                isValid = false;
            }

            if (stock && stock.value.trim() === '') {
                setError(stock, 'Vui lòng nhập số lượng');
                isValid = false;
            }

            if (stock && stock.value.trim() !== '' && Number(stock.value) < 0) {
                setError(stock, 'Số lượng không hợp lệ');
                isValid = false;
            }
        });

        return isValid;
    }

    function addVariant() {
        if (!variantList) return;

        const item = document.createElement('div');
        item.className = 'variant-item';

        item.innerHTML = `
            <button type="button" class="btn-remove-variant">
                <i class='bx bx-x'></i>
            </button>

            <input type="hidden" name="variants[${variantIndex}][id]" value="">

            <div class="variant-grid">

                <div class="form-group">
                    <label>Tên biến thể <span>*</span></label>
                    <input type="text"
                           name="variants[${variantIndex}][variant_name]"
                           placeholder="Ví dụ: Size 28cm">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label>Mã SKU</label>
                    <input type="text"
                           name="variants[${variantIndex}][sku]"
                           placeholder="Tự động tạo">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label>Giá <span>*</span></label>
                    <input type="number"
                           name="variants[${variantIndex}][price]"
                           placeholder="1200000">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label>Giá sale</label>
                    <input type="number"
                           name="variants[${variantIndex}][sale_price]"
                           placeholder="Để trống nếu không sale">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label>Số lượng <span>*</span></label>
                    <input type="number"
                           name="variants[${variantIndex}][stock]"
                           placeholder="20">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="variants[${variantIndex}][status]">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                    <span class="error-message"></span>
                </div>

            </div>
        `;

        variantList.appendChild(item);
        variantIndex++;
    }

    window.addVariant = addVariant;

    document.addEventListener('click', function (e) {
        const removeButton = e.target.closest('.btn-remove-variant');

        if (!removeButton) return;

        const variantItems = document.querySelectorAll('.variant-item');

        if (variantItems.length <= 1) {
            alert('Sản phẩm phải có ít nhất 1 biến thể');
            return;
        }

        removeButton.closest('.variant-item').remove();
    });

    document.addEventListener('input', function (e) {
        if (!e.target.name) return;

        if (
            e.target.name.includes('[price]') ||
            e.target.name.includes('[sale_price]') ||
            e.target.name.includes('[stock]')
        ) {
            formatNumberInput(e.target);
        }

        if (e.target.name.includes('[variant_name]')) {
            updateSkuByVariant(e.target.closest('.variant-item'));
        }

        clearError(e.target);
    });

    const titleInput = document.getElementById('title');

    if (titleInput) {
        titleInput.addEventListener('input', function () {
            updateAllSkus();
            clearError(this);
        });
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

        clearVariantErrors();

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

        updateAllSkus();

        if (!validateVariants()) {
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});