<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {

    $servername = "103.57.220.210";
    $username   = "oaljdfoghosting_KhanhDuy";
    $password   = "wAzyJ~>^Y]p3607";
    $dbname     = "oaljdfoghosting_WebMoHinh";
    $port       = 3306;

    $conn = new PDO(
        "mysql:host=$servername;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $conn->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

} catch (PDOException $e) {

    die(
        "<h2 style='color:red'>
            Lỗi kết nối:
            <br>" . $e->getMessage() . "
        </h2>"
    );

}