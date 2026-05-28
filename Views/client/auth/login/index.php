<?php require_once 'Views/client/layouts/Header.php'; ?>

<main class="auth-page">
    <section class="auth-panel">
        <div class="auth-visual">
            <h1>Đăng nhập tài khoản</h1>
            <p>Theo dõi đơn hàng, lưu sản phẩm yêu thích và mua figure nhanh hơn.</p>
        </div>

        <div class="auth-form-wrap">
            <div class="auth-heading">
                <p>Chào mừng trở lại</p>
                <h2>Đăng nhập</h2>
            </div>

            <form action="#" method="post" class="auth-form">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <div class="auth-input">
                        <i class="fa fa-envelope"></i>
                        <input type="email" id="login-email" name="email" placeholder="email@example.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="login-password">Mật khẩu</label>
                    <div class="auth-input">
                        <i class="fa fa-lock"></i>
                        <input type="password" id="login-password" name="password" placeholder="Nhập mật khẩu" required>
                    </div>
                </div>

                <div class="auth-options">
                    <label class="auth-check">
                        <input type="checkbox" name="remember">
                        <span>Ghi nhớ đăng nhập</span>
                    </label>
                    <a href="#">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="btn auth-submit">
                    Đăng nhập
                </button>
            </form>

            <p class="auth-switch">
                Chưa có tài khoản?
                <a href="index.php?page=register">Đăng ký ngay</a>
            </p>
        </div>
    </section>
</main>

<?php require_once 'Views/client/layouts/Footer.php'; ?>
