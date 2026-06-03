<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    // Thông tin kết nối
    $servername = "103.57.220.210";
    $username   = "oaljdfoghosting_KhanhDuy";
    $password   = "wAzyJ~>^Y]p3607";
    $dbname     = "oaljdfoghosting_WebMoHinh";
    $port       = 3306;

    // Kết nối MySQL
    $conn = new mysqli(
        $servername,
        $username,
        $password,
        $dbname,
        $port
    );

    // UTF8
    $conn->set_charset("utf8mb4");

} catch (Exception $e) {

    die(
        "<h2 style='color:red'>
            Lỗi kết nối:
            <br>" . $e->getMessage() . "
        </h2>"
    );

}