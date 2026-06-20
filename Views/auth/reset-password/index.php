<main class="auth-page">
    <section class="auth-panel">

        <div class="auth-visual">
            <span class="auth-badge">Đặt lại mật khẩu</span>

            <h1>Tạo mật khẩu mới</h1>

            <p>Mật khẩu mới phải có ít nhất 6 ký tự.</p>

            <img src="assets/client/img/goku.jpg"
                 alt="Reset Password"
                 class="auth-figure-img">
        </div>

        <div class="auth-form-wrap">

            <div class="auth-heading">
                <h2>Mật khẩu mới</h2>
            </div>

            <?php if (!empty($error)): ?>
                <div class="auth-alert error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="auth-alert success">
                    <?= htmlspecialchars($success) ?>
                </div>

                <p class="auth-switch">
                    <a href="index.php?page=login">Đăng nhập ngay</a>
                </p>
            <?php else: ?>

                <form action="index.php?page=reset-password"
                      method="post"
                      class="auth-form">

                    <div class="form-group">
                        <label>Mật khẩu mới</label>

                        <div class="auth-input">
                            <i class="fa fa-lock"></i>

                            <input
                                type="password"
                                name="password"
                                placeholder="Nhập mật khẩu mới"
                                minlength="6"
                                required>
                        </div>

                        <?php if (!empty($errors['password'])): ?>
                            <small class="error-message">
                                <?= htmlspecialchars($errors['password']) ?>
                            </small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Xác nhận mật khẩu</label>

                        <div class="auth-input">
                            <i class="fa fa-lock"></i>

                            <input
                                type="password"
                                name="confirm_password"
                                placeholder="Nhập lại mật khẩu"
                                minlength="6"
                                required>
                        </div>

                        <?php if (!empty($errors['confirm_password'])): ?>
                            <small class="error-message">
                                <?= htmlspecialchars($errors['confirm_password']) ?>
                            </small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn auth-submit">
                        Cập nhật mật khẩu
                    </button>

                </form>

            <?php endif; ?>

        </div>

    </section>
</main>

<?php require_once 'Views/client/layouts/Footer.php'; ?>