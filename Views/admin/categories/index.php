<div class="box">
    <div class="box-title">
        <h2>Danh sách danh mục</h2>

        <a href="index.php?page=category-add" class="btn-primary">
            <i class='bx bx-plus'></i>
            <span>Thêm danh mục</span>
        </a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ten danh muc</th>
                    <th>Mo ta</th>
                    <th>Trang thai</th>
                    <th>Thao tac</th>
                </tr>
            </thead>
            <tbody>
                <?php $categories = $categories ?? []; ?>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td>#<?= $category['id'] ?></td>
                        <td><strong><?= $category['name'] ?></strong></td>
                        <td><?= $category['description'] ?></td>
                        <td>
                            <span class="status <?= $category['status'] === 'Hien thi' || $category['status'] === 'Hiển thị' ? 'confirmed' : 'cancelled' ?>">
                                <?= $category['status'] ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">

                                <a href="index.php?page=category-edit&id=<?= $category['id'] ?>"
                                    class="action-btn edit"
                                    title="Sửa">
                                    <i class='bx bx-edit'></i>
                                </a>

                                <a href="index.php?page=category-delete&id=<?= $category['id'] ?>"
                                    class="action-btn delete"
                                    title="Xóa"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                    <i class='bx bx-trash'></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Xóa danh mục?',
        text: 'Dữ liệu sẽ không thể khôi phục!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href =
                'index.php?page=category-delete&id=' + id;
        }
    });
}
</script>