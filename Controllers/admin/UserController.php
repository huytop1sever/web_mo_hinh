<?php

class UserController
{
    public function index()
    {
        $title = 'Quản lý người dùng';
        $pageTitle = 'Người dùng';

        $userModel = new User();
        $users = $userModel->getAll();

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';
        include_once '../Views/admin/users/index.php';
        include_once '../Views/admin/layouts/footer.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'password' => $_POST['password'] ?? '',
                'role' => $_POST['role'] ?? 'user',
                'status' => $_POST['status'] ?? 1
            ];

            $userModel = new User();
            $userModel->create($data);
        }

        header('Location: index.php?act=users');
        exit;
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'password' => $_POST['password'] ?? '',
                'role' => $_POST['role'] ?? 'user',
                'status' => $_POST['status'] ?? 1
            ];

            $userModel = new User();
            $userModel->update($id, $data);
        }

        header('Location: index.php?act=users');
        exit;
    }

    public function lock()
    {
        $id = $_GET['id'] ?? 0;

        if ($id) {
            $userModel = new User();
            $userModel->lock($id);
        }

        header('Location: index.php?page=users&msg=locked');
        exit;
    }

    public function unlock()
    {
        $id = $_GET['id'] ?? 0;

        if ($id) {
            $userModel = new User();
            $userModel->unlock($id);
        }

        header('Location: index.php?page=users&msg=unlocked');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? 0;

        if ($id) {
            $userModel = new User();
            $userModel->delete($id);
        }

        header('Location: index.php?page=users&msg=deleted');
        exit;
    }
}