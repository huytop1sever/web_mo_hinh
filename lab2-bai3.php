<?php
class SinhVien
{
    private $mssv;
    private $hoten;
    private $gioitinh;
    private $ngaysinh;
    private $diemtb;

    // Default constructor
    public function __construct(
        $mssv = "",
        $hoten = "",
        $gioitinh = "",
        $ngaysinh = "",
        $diemtb = 0
    ) {
        $this->mssv = $mssv;
        $this->hoten = $hoten;
        $this->gioitinh = $gioitinh;
        $this->ngaysinh = $ngaysinh;
        $this->diemtb = $diemtb;
    }

    // Getter và Setter
    public function getMssv()
    {
        return $this->mssv;
    }

    public function setMssv($mssv)
    {
        $this->mssv = $mssv;
    }

    public function getHoten()
    {
        return $this->hoten;
    }

    public function setHoten($hoten)
    {
        $this->hoten = $hoten;
    }

    public function getGioitinh()
    {
        return $this->gioitinh;
    }

    public function setGioitinh($gioitinh)
    {
        $this->gioitinh = $gioitinh;
    }

    public function getNgaysinh()
    {
        return $this->ngaysinh;
    }

    public function setNgaysinh($ngaysinh)
    {
        $this->ngaysinh = $ngaysinh;
    }

    public function getDiemtb()
    {
        return $this->diemtb;
    }

    public function setDiemtb($diemtb)
    {
        $this->diemtb = $diemtb;
    }

    // Hiển thị thông tin
    public function hienThiThongTin()
    {
        return "
            <tr>
                <td>{$this->mssv}</td>
                <td>{$this->hoten}</td>
                <td>{$this->gioitinh}</td>
                <td>{$this->ngaysinh}</td>
                <td>{$this->diemtb}</td>
            </tr>
        ";
    }
}

// Tạo mảng sinh viên
$mangSinhVien = [];

// Xử lý submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sv = new SinhVien(
        $_POST['mssv'],
        $_POST['hoten'],
        $_POST['gioitinh'],
        $_POST['ngaysinh'],
        $_POST['diemtb']
    );

    $mangSinhVien[] = $sv;
}
?>
<h2>Nhập Thông Tin Sinh Viên</h2>
<link rel="stylesheet" href="style.css">

<form method="POST">

    <label>MSSV</label>
    <input type="text" name="mssv" required>

    <label>Họ tên</label>
    <input type="text" name="hoten" required>

    <label>Giới tính</label>
    <select name="gioitinh">
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select>

    <label>Ngày sinh</label>
    <input type="date" name="ngaysinh" required>

    <label>Điểm trung bình</label>
    <input type="number" step="0.1" name="diemtb" required>

    <button type="submit">Lưu Sinh Viên</button>

</form>

<h2>Danh Sách Sinh Viên</h2>

<table>
    <tr>
        <th>MSSV</th>
        <th>Họ tên</th>
        <th>Giới tính</th>
        <th>Ngày sinh</th>
        <th>Điểm TB</th>
    </tr>

    <?php
        foreach ($mangSinhVien as $sv) {
            echo $sv->hienThiThongTin();
        }
    ?>

</table>

</body>
</html>