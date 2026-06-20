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

            <img src="assets/client/img/luffy-gear-5.jpg"
                 alt="Figure"
                 class="auth-figure-img">
        </div>

        <div class="auth-form-wrap">

            <div class="auth-heading">
                <p>Chào mừng trở lại</p>
                <h2>Đăng nhập</h2>
            </div>

            <?php if (!empty($error)): ?>
                <div class="auth-alert error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="index.php?page=login"
                  method="post"
                  class="auth-form"
                  novalidate>

                <div class="form-group">
                    <label>Email</label>

                    <div class="auth-input">
                        <i class="fa fa-envelope"></i>

                        <input
                            type="email"
                            name="email"
                            placeholder="email@example.com"
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                    </div>

                    <?php if (!empty($errors['email'])): ?>
                        <small class="error-message">
                            <?= htmlspecialchars($errors['email']) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>

                    <div class="auth-input">
                        <i class="fa fa-lock"></i>

                        <input
                            type="password"
                            name="password"
                            placeholder="Nhập mật khẩu">
                    </div>

                    <?php if (!empty($errors['password'])): ?>
                        <small class="error-message">
                            <?= htmlspecialchars($errors['password']) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <div class="auth-options">
                    <label class="auth-check">
                        <input type="checkbox" name="remember">
                        <span>Ghi nhớ đăng nhập</span>
                    </label>

                    <a href="index.php?page=forgot-password">
                        Quên mật khẩu?
                    </a>
                </div>

                <button type="submit" class="btn auth-submit">
                    Đăng nhập
                </button>

            </form>

            <p class="auth-switch">
                Chưa có tài khoản?
                <a href="index.php?page=register">
                    Đăng ký ngay
                </a>
            </p>

        </div>

    </section>
</main>

<?php require_once 'Views/client/layouts/Footer.php'; ?>