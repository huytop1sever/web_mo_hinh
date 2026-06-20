<?php

class CategoryController
{
    public function index()
    {
        $title = 'Quản lý danh mục';
        $pageTitle = 'Danh mục';

        // Lấy dữ liệu danh mục từ database
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        // Chuẩn hóa key để khớp với view
        foreach ($categories as &$c) {
            $c['product_count'] = $c['product_count'] ?? 0;
            // Một số DB có thể lưu status dạng khác nhau
            if (empty($c['status'])) {
                $c['status'] = 'Hiển thị';
            }
        }
        unset($c);


        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';

        include_once '../Views/admin/categories/index.php';

        include_once '../Views/admin/layouts/footer.php';
    }

    public function add()
    {
        $title = 'Thêm danh mục mới';
        $pageTitle = 'Thêm danh mục';

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';

        include_once '../Views/admin/categories/add.php';

        include_once '../Views/admin/layouts/footer.php';
    }


    public function edit($id)
    {
        $title = 'Chỉnh sửa danh mục';
        $pageTitle = 'Sửa danh mục';

        $categoryModel = new Category();
        $category = $categoryModel->find($id);

        if (!$category) {
            header('Location: index.php?page=categories');
            exit;
        }

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';

        include_once '../Views/admin/categories/edit.php';

        include_once '../Views/admin/layouts/footer.php';
    }

    public function store()
    {
        $categoryModel = new Category();
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $status = trim($_POST['status'] ?? '');

        if ($name === '' || $description === '' || $status === '') {
            header('Location: index.php?page=category-add');
            exit;
        }

        $categoryModel->create([
            'name' => $name,
            'description' => $description,
            'status' => $status,
        ]);

        header('Location: index.php?page=categories');
        exit;
    }

    public function update()
    {
        $categoryModel = new Category();
        $id = (int)($_POST['id'] ?? 0);

        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $status = trim($_POST['status'] ?? '');

        if ($id <= 0 || $name === '' || $description === '' || $status === '') {
            header('Location: index.php?page=categories');
            exit;
        }

        $categoryModel->update($id, [
            'name' => $name,
            'description' => $description,
            'status' => $status,
        ]);

        header('Location: index.php?page=categories');
        exit;
    }

    public function delete($id)
    {
        $categoryModel = new Category();
        $id = (int)$id;

        if ($id > 0) {
            $categoryModel->delete($id);
        }

        header('Location: index.php?page=categories');
        exit;
    }

}
