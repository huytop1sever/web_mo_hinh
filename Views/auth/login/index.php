<?php require_once 'Views/client/layouts/Header.php'; ?>

<main class="auth-page">
    <section class="auth-panel">
        <div class="auth-visual">
    <span class="auth-badge">
        Phantom Figure Store
    </span>

    <h1>Bộ sưu tập mô hình Anime cao cấp</h1>

    <p>
        Khám phá hàng trăm figure One Piece, Naruto,
        Dragon Ball, Demon Slayer và nhiều bộ sưu tập giới hạn.
    </p>

    <img src="assets/client/img/luffy-login.png"
         alt="Figure"
         class="auth-figure-img">
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
