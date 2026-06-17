<!-- Header phong cách mới: Tối giản và sang trọng -->
<div class="container-fluid page-header py-5" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/client/img/banner-blog.jpg'); background-size: cover; margin-top: 90px;">
    <h1 class="text-center text-white display-6 fw-light text-uppercase ls-2">Tin tức & Sự kiện</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php" class="text-white">Trang chủ</a></li>
        <li class="breadcrumb-item active text-white">Bài viết</li>
    </ol>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $item): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 overflow-hidden post-card-modern">
                        <div class="position-relative">
                            <div class="post-img-wrapper">
                                <img src="assets/client/img/<?= htmlspecialchars($item['image'] ?? 'no-image.png') ?>" 
                                     class="card-img-top" 
                                     alt="<?= htmlspecialchars($item['title']) ?>">
                            </div>
                            <div class="post-date-badge">
                                <span class="day"><?= date('d', strtotime($item['created_at'])) ?></span>
                                <span class="month">Th<?= date('m', strtotime($item['created_at'])) ?></span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title mb-2">
                                <a href="index.php?page=post-detail&id=<?= $item['id'] ?>" class="post-title-link">
                                    <?= htmlspecialchars($item['title']) ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-4 small">
                                <?= htmlspecialchars(mb_strimwidth($item['excerpt'] ?? $item['content'], 0, 120, "...")) ?>
                            </p>
                            <a href="index.php?page=post-detail&id=<?= $item['id'] ?>" class="read-more-link">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <h3>Hiện chưa có bài viết nào.</h3>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.post-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.post-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.post-card .card-title a:hover {
    color: #81c408 !important;
}
</style>