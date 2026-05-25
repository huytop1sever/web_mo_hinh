<div class="users-page">

    <div class="box">

        <div class="box-title">

            <h2>Quản lý người dùng</h2>

            <button class="btn-primary" onclick="openUserModal()">
                <i class='bx bx-plus'></i>
                Thêm user
            </button>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>#U001</td>

                        <td>Nguyễn Văn A</td>

                        <td>admin@gmail.com</td>

                        <td>
                            <span class="role admin">
                                Admin
                            </span>
                        </td>

                        <td>
                            <span class="status confirmed">
                                Hoạt động
                            </span>
                        </td>

                        <td>

                            <div class="table-actions">

                                <button class="action-btn edit" onclick="openUserModal()">
                                    <i class='bx bx-edit'></i>
                                </button>

                                <button class="action-btn lock" onclick="openLockModal()">
                                    <i class='bx bx-lock-alt'></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td>#U002</td>

                        <td>Trần Văn B</td>

                        <td>staff@gmail.com</td>

                        <td>
                            <span class="role staff">
                                Staff
                            </span>
                        </td>

                        <td>
                            <span class="status cancelled">
                                Đã khóa
                            </span>
                        </td>

                        <td>

                            <div class="table-actions">

                                <button class="action-btn edit" onclick="openUserModal()">
                                    <i class='bx bx-edit'></i>
                                </button>

                                <button class="action-btn unlock" onclick="openUnlockModal()">
                                    <i class='bx bx-lock-open-alt'></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- USER MODAL -->

<div class="modal" id="userModal">

    <div class="modal-box">

        <div class="modal-header">

            <h3>Thông tin người dùng</h3>

            <button class="modal-close" onclick="closeUserModal()">
                <i class='bx bx-x'></i>
            </button>

        </div>

        <form class="user-form">

            <div class="form-group">
                <label>Họ tên</label>
                <input type="text" placeholder="Nhập họ tên">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="Nhập email">
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" placeholder="Nhập số điện thoại">
            </div>

            <div class="form-group">
                <label>Vai trò</label>

                <select>

                    <option>Admin</option>
                    <option>Staff</option>
                    <option>User</option>

                </select>

            </div>

            <div class="form-actions">

                <button type="button" class="btn-cancel" onclick="closeUserModal()">
                    Hủy
                </button>

                <button type="submit" class="btn-save">
                    Lưu
                </button>

            </div>

        </form>

    </div>

</div>

<!-- LOCK MODAL -->

<div class="modal" id="lockModal">

    <div class="confirm-modal">

        <i class='bx bx-lock-alt'></i>

        <h3>Khóa tài khoản?</h3>

        <p>User sẽ không thể đăng nhập hệ thống.</p>

        <div class="confirm-actions">

            <button class="btn-cancel" onclick="closeLockModal()">
                Hủy
            </button>

            <button class="btn-danger">
                Khóa tài khoản
            </button>

        </div>

    </div>

</div>

<!-- UNLOCK MODAL -->

<div class="modal" id="unlockModal">

    <div class="confirm-modal">

        <i class='bx bx-lock-open-alt'></i>

        <h3>Mở khóa tài khoản?</h3>

        <p>User sẽ được phép đăng nhập lại.</p>

        <div class="confirm-actions">

            <button class="btn-cancel" onclick="closeUnlockModal()">
                Hủy
            </button>

            <button class="btn-success">
                Mở khóa
            </button>

        </div>

    </div>

</div>

<script>

    const userModal = document.getElementById('userModal');
    const lockModal = document.getElementById('lockModal');
    const unlockModal = document.getElementById('unlockModal');

    function openUserModal() {
        userModal.classList.add('show');
    }

    function closeUserModal() {
        userModal.classList.remove('show');
    }

    function openLockModal() {
        lockModal.classList.add('show');
    }

    function closeLockModal() {
        lockModal.classList.remove('show');
    }

    function openUnlockModal() {
        unlockModal.classList.add('show');
    }

    function closeUnlockModal() {
        unlockModal.classList.remove('show');
    }

</script>