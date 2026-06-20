<main class="auth-page">
    <section class="auth-panel auth-panel-register">

        <div class="auth-visual">
            <span class="auth-badge">Thành viên mới</span>

            <h1>Tạo tài khoản mua sắm</h1>

            <p>
                Lưu địa chỉ giao hàng, nhận ưu đãi và quản lý
                bộ sưu tập figure của bạn.
            </p>

            <img src="assets/client/img/goku.jpg"
                 alt="Register"
                 class="auth-figure-img">
        </div>

        <div class="auth-form-wrap">

            <div class="auth-heading">
                <h2>Đăng ký</h2>
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
            <?php endif; ?>

            <form action="index.php?page=register"
                  method="post"
                  class="auth-form"
                  novalidate>

                <div class="form-group">
                    <label>Họ và tên</label>

                    <div class="auth-input">
                        <i class="fa fa-user"></i>

                        <input
                            type="text"
                            name="name"
                            placeholder="Nhập họ tên"
                            value="<?= htmlspecialchars($old['name'] ?? '') ?>">
                    </div>

                    <?php if (!empty($errors['name'])): ?>
                        <small class="error-message">
                            <?= htmlspecialchars($errors['name']) ?>
                        </small>
                    <?php endif; ?>
                </div>

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
                    <label>Số điện thoại</label>

                    <div class="auth-input">
                        <i class="fa fa-phone"></i>

                        <input
                            type="text"
                            name="phone"
                            placeholder="nhập số điện thoại"
                            value="<?= htmlspecialchars($old['phone'] ?? '') ?>">
                    </div>

                    <?php if (!empty($errors['phone'])): ?>
                        <small class="error-message">
                            <?= htmlspecialchars($errors['phone']) ?>
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
                            placeholder="Tạo mật khẩu">
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
                            placeholder="Nhập lại mật khẩu">
                    </div>

                    <?php if (!empty($errors['confirm_password'])): ?>
                        <small class="error-message">
                            <?= htmlspecialchars($errors['confirm_password']) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <label class="auth-check auth-policy">
                    <input type="checkbox" name="policy">
                    <span>
                        Tôi đồng ý với điều khoản và chính sách bảo mật.
                    </span>
                </label>

                <?php if (!empty($errors['policy'])): ?>
                    <small class="error-message">
                        <?= htmlspecialchars($errors['policy']) ?>
                    </small>
                <?php endif; ?>

                <button type="submit" class="btn auth-submit">
                    Tạo tài khoản
                </button>

            </form>

            <p class="auth-switch">
                Đã có tài khoản?
                <a href="index.php?page=login">
                    Đăng nhập
                </a>
            </p>

        </div>

    </section>
</main>

<?php require_once 'Views/client/layouts/Footer.php'; ?>