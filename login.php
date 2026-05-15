<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "123456") {

        $_SESSION['is_logged_in'] = true;
        $_SESSION['username'] = $username;

        header("Location: home.php");

    } else {

        echo "Đăng nhập thất bại!";
    }
}

?>

<form action="" method="POST">

    <input type="text" name="username" placeholder="Tài khoản">
    <br><br>

    <input type="password" name="password" placeholder="Mật khẩu">
    <br><br>

    <button type="submit">Đăng nhập</button>

</form>