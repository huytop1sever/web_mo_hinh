<?php $users = $users ?? []; ?>

<?php if (isset($_GET['msg'])): ?>

<div id="toast" class="toast-message">
    <?php
    switch ($_GET['msg']) {
        case 'locked':
            echo "🔒 Khóa tài khoản thành công";
            break;

        case 'unlocked':
            echo "🔓 Mở khóa tài khoản thành công";
            break;

        case 'deleted':
            echo "🗑️ Xóa tài khoản thành công";
            break;

        case 'error':
            echo "❌ Có lỗi xảy ra";
            break;
    }
    ?>
</div>

<?php endif; ?>

<div class="users-page">

    <div class="box">

        <div class="box-title">
            <h2>Quản lý người dùng</h2>
        </div>

        <div class="table-wrapper">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>#U<?= $user['id'] ?></td>

                            <td><?= htmlspecialchars($user['name'] ?? '') ?></td>

                            <td><?= htmlspecialchars($user['email'] ?? '') ?></td>

                            <td><?= htmlspecialchars($user['phone'] ?? '') ?></td>

                            <td>
                                <span class="role <?= strtolower($user['role'] ?? 'user') ?>">
                                    <?= ucfirst($user['role'] ?? 'user') ?>
                                </span>
                            </td>

                            <td>
                                <?php if ($user['status'] == 1): ?>
                                    <span class="status confirmed">Hoạt động</span>
                                <?php else: ?>
                                    <span class="status cancelled">Đã khóa</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="table-actions">

                                    <?php if ($user['status'] == 1): ?>
                                        <a 
                                            class="action-btn lock"
                                            href="index.php?page=user-lock&id=<?= $user['id'] ?>"
                                            onclick="return openConfirmModal(this, 'lock')"
                                        >
                                            <i class='bx bx-lock-alt'></i>
                                        </a>
                                    <?php else: ?>
                                        <a 
                                            class="action-btn unlock"
                                            href="index.php?page=user-unlock&id=<?= $user['id'] ?>"
                                            onclick="return openConfirmModal(this, 'unlock')"
                                        >
                                            <i class='bx bx-lock-open-alt'></i>
                                        </a>
                                    <?php endif; ?>

                                    <a 
                                        class="action-btn delete"
                                        href="index.php?page=user-delete&id=<?= $user['id'] ?>"
                                        onclick="return openConfirmModal(this, 'delete')"
                                    >
                                        <i class='bx bx-trash'></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="7" style="text-align:center;">
                                Chưa có người dùng
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>

    </div>

</div>

<div class="modal" id="confirmModal">

    <div class="confirm-modal">

        <i id="confirmIcon" class='bx bx-help-circle'></i>

        <h3 id="confirmTitle">Xác nhận</h3>

        <p id="confirmText">Bạn có chắc muốn thực hiện thao tác này?</p>

        <div class="confirm-actions">

            <button type="button" class="btn-cancel" onclick="closeConfirmModal()">
                Hủy
            </button>

            <a href="#" id="confirmBtn" class="btn-danger">
                Đồng ý
            </a>

        </div>

    </div>

</div>