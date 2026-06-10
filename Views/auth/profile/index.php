<?php require_once 'Views/client/layouts/header.php'; ?>

<main class="profile-page" style="padding-top: 170px; padding-bottom: 60px;">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <img src="assets/client/img/avatar.jpg"
                                 alt="Avatar"
                                 class="rounded-circle mb-3"
                                 width="120"
                                 height="120"
                                 style="object-fit: cover;">

                            <h3 class="mb-1">
                                <?= htmlspecialchars($_SESSION['user']['name']) ?>
                            </h3>

                            <p class="text-muted mb-0">
                                <?= htmlspecialchars($_SESSION['user']['email']) ?>
                            </p>
                        </div>

                        <hr>

                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded-3">
                                    <small class="text-muted">Mã tài khoản</small>
                                    <h6 class="mb-0">
                                        #<?= htmlspecialchars($_SESSION['user']['id']) ?>
                                    </h6>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded-3">
                                    <small class="text-muted">Vai trò</small>
                                    <h6 class="mb-0">
                                        <?= htmlspecialchars($_SESSION['user']['role']) ?>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <a href="index.php" class="btn btn-outline-primary">
                                Về trang chủ
                            </a>

                            <a href="index.php?page=logout" class="btn btn-danger">
                                Đăng xuất
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</main>

<?php require_once 'Views/client/layouts/Footer.php'; ?>