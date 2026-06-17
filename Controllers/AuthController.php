<?php

class AuthController
{
    public function login()
    {
        $error = '';
        $errors = [];
        $old = [
            'email' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $old['email'] = $email;

            if ($email === '') {
                $errors['email'] = 'Vui lòng nhập email';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            }

            if ($password === '') {
                $errors['password'] = 'Vui lòng nhập mật khẩu';
            }

            if (empty($errors)) {
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
        $errors = [];

        $old = [
            'name' => '',
            'email' => '',
            'phone' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirmPassword = trim($_POST['confirm_password'] ?? '');

            $old['name'] = $name;
            $old['email'] = $email;
            $old['phone'] = $phone;

            if ($name === '') {
                $errors['name'] = 'Vui lòng nhập họ tên';
            } elseif (mb_strlen($name) < 2) {
                $errors['name'] = 'Họ tên phải có ít nhất 2 ký tự';
            }

            if ($email === '') {
                $errors['email'] = 'Vui lòng nhập email';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            }

            if ($phone === '') {
                $errors['phone'] = 'Vui lòng nhập số điện thoại';
            } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
                $errors['phone'] = 'Số điện thoại phải gồm đúng 10 chữ số';
            }

            if ($password === '') {
                $errors['password'] = 'Vui lòng nhập mật khẩu';
            } elseif (strlen($password) < 6) {
                $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }

            if ($confirmPassword === '') {
                $errors['confirm_password'] = 'Vui lòng nhập lại mật khẩu';
            } elseif ($password !== $confirmPassword) {
                $errors['confirm_password'] = 'Mật khẩu xác nhận không khớp';
            }

            if (empty($errors)) {
                $userModel = new User();

                if ($userModel->findByEmail($email)) {
                    $errors['email'] = 'Email đã tồn tại';
                } else {
                    $userModel->register([
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'password' => $password
                    ]);

                    $success = 'Đăng ký thành công, vui lòng đăng nhập';

                    $old = [
                        'name' => '',
                        'email' => '',
                        'phone' => ''
                    ];
                }
            }

            
        }

        require_once 'Views/auth/register/index.php';
    }

    public function forgotPassword()
    {
        $error = '';
        $errors = [];
        $old = [
            'email' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $old['email'] = $email;

            if ($email === '') {
                $errors['email'] = 'Vui lòng nhập email';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            }

            if (empty($errors)) {
                $userModel = new User();
                $user = $userModel->findByEmail($email);

                if (!$user) {
                    $errors['email'] = 'Email không tồn tại';
                } elseif (($user['role'] ?? 'client') === 'admin') {
                    $error = 'Không thể đặt lại mật khẩu tài khoản admin tại trang client';
                } elseif (($user['status'] ?? 1) == 0) {
                    $error = 'Tài khoản đã bị khóa';
                } else {
                    $_SESSION['reset_email'] = $email;

                    header('Location: index.php?page=reset-password');
                    exit;
                }
            }

            if (!empty($errors)) {
                $error = 'Vui lòng kiểm tra lại thông tin';
            }
        }

        require_once 'Views/auth/forgot-password/index.php';
    }

    public function resetPassword()
    {
        if (empty($_SESSION['reset_email'])) {
            header('Location: index.php?page=forgot-password');
            exit;
        }

        $error = '';
        $success = '';
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = trim($_POST['password'] ?? '');
            $confirmPassword = trim($_POST['confirm_password'] ?? '');

            if ($password === '') {
                $errors['password'] = 'Vui lòng nhập mật khẩu mới';
            } elseif (strlen($password) < 6) {
                $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }

            if ($confirmPassword === '') {
                $errors['confirm_password'] = 'Vui lòng nhập lại mật khẩu';
            } elseif ($password !== $confirmPassword) {
                $errors['confirm_password'] = 'Mật khẩu xác nhận không khớp';
            }

            if (empty($errors)) {
                $userModel = new User();
                $userModel->updatePasswordByEmail($_SESSION['reset_email'], $password);

                unset($_SESSION['reset_email']);

                $success = 'Đổi mật khẩu thành công, vui lòng đăng nhập';
            } else {
                $error = 'Vui lòng kiểm tra lại thông tin';
            }
        }

        require_once 'Views/auth/reset-password/index.php';
    }

  public function profile()
{
    if (empty($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    require_once 'Models/Order.php';

    $userModel = new User();
    $orderModel = new Order();

    $user = $userModel->find($_SESSION['user']['id']);

    if (!$user) {
        unset($_SESSION['user']);
        header('Location: index.php?page=login');
        exit;
    }

    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'phone' => $user['phone'] ?? '',
        'role' => $user['role'] ?? 'client'
    ];

    $orders = $orderModel->getByUserId($user['id']);
    $totalOrders = $orderModel->countByUserId($user['id']);

    require_once 'Views/auth/profile/index.php';
}

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['reset_email']);

        header('Location: index.php?page=login');
        exit;
    }
}