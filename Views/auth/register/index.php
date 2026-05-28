<?php require_once 'Views/client/layouts/Header.php'; ?>

<main class="auth-page">
    <section class="auth-panel auth-panel-register">
        <div class="auth-visual">
            <span class="auth-badge">Thành viên mới</span>
            <h1>Tạo tài khoản mua sắm</h1>
            <p>Lưu địa chỉ giao hàng, nhận ưu đãi và quản lý bộ sưu tập figure của bạn.</p>
        </div>

        <div class="auth-form-wrap">
            <div class="auth-heading">
                <h2>Đăng ký</h2>
            </div>

            <form action="#" method="post" class="auth-form">
                <div class="form-group">
                    <label for="register-name">Họ và tên</label>
                    <div class="auth-input">
                        <i class="fa fa-user"></i>
                        <input type="text" id="register-name" name="name" placeholder="Nhập họ tên" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="register-email">Email</label>
                    <div class="auth-input">
                        <i class="fa fa-envelope"></i>
                        <input type="email" id="register-email" name="email" placeholder="email@example.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="register-phone">Số điện thoại</label>
                    <div class="auth-input">
                        <i class="fa fa-phone"></i>
                        <input type="tel" id="register-phone" name="phone" placeholder="0909 999 999" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="register-password">Mật khẩu</label>
                    <div class="auth-input">
                        <i class="fa fa-lock"></i>
                        <input type="password" id="register-password" name="password" placeholder="Tạo mật khẩu" required>
                    </div>
                </div>

                <label class="auth-check auth-policy">
                    <input type="checkbox" name="policy" required>
                    <span>Tôi đồng ý với điều khoản và chính sách bảo mật.</span>
                </label>

                <button type="submit" class="btn auth-submit">
                    Tạo tài khoản
                </button>
            </form>

            <p class="auth-switch">
                Đã có tài khoản?
                <a href="index.php?page=login">Đăng nhập</a>
            </p>
        </div>
    </section>
</main>

<?php require_once 'Views/client/layouts/Footer.php'; ?>
