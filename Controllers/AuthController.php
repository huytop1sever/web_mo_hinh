<?php

require_once 'Models/User.php';

class AuthController
{
    public function login()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($email === '' || $password === '') {
                $error = 'Vui lòng nhập đầy đủ email và mật khẩu';
            } else {
                $userModel = new User();
                $user = $userModel->findByEmail($email);

                if (!$user || !password_verify($password, $user['password'])) {
                    $error = 'Email hoặc mật khẩu không đúng';
                } elseif (($user['role'] ?? 'client') === 'admin') {
                    $error = 'Tài khoản admin không được đăng nhập ở trang client';
                } elseif (($user['status'] ?? 1) == 0) {
                    $error = 'Tài khoản đã bị khóa';
                } else {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'phone' => $user['phone'] ?? '',
                        'role' => $user['role'] ?? 'client'
                    ];

                    header('Location: index.php?page=profile');
                    exit;
                }
            }
        }

        require_once 'Views/auth/login/index.php';
    }

    public function register()
    {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirmPassword = trim($_POST['confirm_password'] ?? '');

            if ($name === '' || $email === '' || $phone === '' || $password === '' || $confirmPassword === '') {
                $error = 'Vui lòng nhập đầy đủ thông tin';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Email không hợp lệ';
            } elseif (!preg_match('/^[0-9]{10,11}$/', $phone)) {
                $error = 'Số điện thoại không hợp lệ';
            } elseif ($password !== $confirmPassword) {
                $error = 'Mật khẩu xác nhận không khớp';
            } else {
                $userModel = new User();

                if ($userModel->findByEmail($email)) {
                    $error = 'Email đã tồn tại';
                } else {
                    $userModel->register([
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'password' => $password
                    ]);

                    $success = 'Đăng ký thành công, vui lòng đăng nhập';
                }
            }
        }

        require_once 'Views/auth/register/index.php';
    }

    public function profile()
    {
        if (empty($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        require_once 'Views/auth/profile/index.php';
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: index.php?page=login');
        exit;
    }
}