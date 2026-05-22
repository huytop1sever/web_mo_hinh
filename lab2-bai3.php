<?php

class SinhVien{
    private $hoTen;
    private $gioiTinh;
    private $ngaySinh;
    private $diemTB;

    public function __construct($hoTen, $gioiTinh, $ngaySinh, $diemTB) {
        $this->hoTen = $hoTen;
        $this->gioiTinh = $gioiTinh;
        $this->ngaySinh = $ngaySinh;
        $this->diemTB = $diemTB;
    }

    public function getHoTen() {
        return $this->hoTen;
    }

    public function getGioiTinh() {
        return $this->gioiTinh;
    }

    public function getNgaySinh() {
        return $this->ngaySinh;
    }

    public function getDiemTB() {
        return $this->diemTB;
    }

    public function hienthiThongTin() {
        echo "Họ tên: " . $this->getHoTen() . "<br>";
        echo "Giới tính: " . $this->getGioiTinh() . "<br>";
        echo "Ngày sinh: " . $this->getNgaySinh() . "<br>";
        echo "Điểm trung bình: " . $this->getDiemTB() . "<br>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $hoTen = $_POST['hoTen'];
    $gioiTinh = $_POST['gioiTinh'];
    $ngaySinh = $_POST['ngaySinh'];
    $diemTB = $_POST['diemTB'];

    $sv = new SinhVien($hoTen, $gioiTinh, $ngaySinh, $diemTB);

    echo "<h2>Thông tin sinh viên</h2>";
    $sv->hienthiThongTin();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Nhập thông tin sinh viên</title>
</head>
<body>

<h1>Nhập thông tin sinh viên</h1>

<form action="" method="post">

    <label>Họ tên:</label>
    <input type="text" name="hoTen" required>
    <br><br>

    <label>Giới tính:</label>
    <select name="gioiTinh" required>
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
        <option value="Khác">Khác</option>
    </select>
    <br><br>

    <label>Ngày sinh:</label>
    <input type="date" name="ngaySinh" required>
    <br><br>

    <label>Điểm trung bình:</label>
    <input type="number" name="diemTB" step="0.01" min="0" max="10" required>
    <br><br>

    <button type="submit">Gửi</button>

</form>

</body>
</html>