<?php require_once 'Views/client/layouts/header.php'; ?>

<main class="auth-page">
    <section class="auth-panel">

        <div class="auth-visual">
            <span class="auth-badge">Khôi phục tài khoản</span>

            <h1>Quên mật khẩu?</h1>

            <p>Nhập email đã đăng ký để đặt lại mật khẩu.</p>

            <img src="assets/client/img/luffy-gear-5.jpg"
                 alt="Forgot Password"
                 class="auth-figure-img">
        </div>

        <div class="auth-form-wrap">

            <div class="auth-heading">
                <h2>Quên mật khẩu</h2>
            </div>

            <?php if (!empty($error)): ?>
                <div class="auth-alert error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="index.php?page=forgot-password"
                  method="post"
                  class="auth-form">

                <div class="form-group">
                    <label>Email</label>

                    <div class="auth-input">
                        <i class="fa fa-envelope"></i>

                        <input
                            type="email"
                            name="email"
                            placeholder="email@example.com"
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                            required>
                    </div>

                    <?php if (!empty($errors['email'])): ?>
                        <small class="error-message">
                            <?= htmlspecialchars($errors['email']) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn auth-submit">
                    Tiếp tục
                </button>

            </form>

            <p class="auth-switch">
                <a href="index.php?page=login">Quay lại đăng nhập</a>
            </p>

        </div>

    </section>
</main>

<?php require_once 'Views/client/layouts/Footer.php'; ?>