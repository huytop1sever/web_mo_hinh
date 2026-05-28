<?php

class AuthController
{
    public function login()
    {
        require_once 'Views/auth/login/index.php';
    }

    public function register()
    {
        require_once 'Views/auth/register/index.php';
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header('Location: index.php');
        exit;
    }
}
