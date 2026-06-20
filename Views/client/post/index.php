<?php
$posts = $posts ?? [];
?>

<!-- Header -->
<div class="container-fluid page-header py-5"
     style="background: linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)), url('assets/client/img/banner-blog.jpg');
            background-size: cover;
            background-position: center;
            margin-top: 90px;">

    <div class="container text-center">
        <h1 class="display-4 text-white fw-bold mb-3">
            Tin tức & Sự kiện
        </h1>

        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item">
                <a href="index.php" class="text-white text-decoration-none">
                    Trang chủ
                </a>
            </li>

            <li class="breadcrumb-item active text-white">
                Bài viết
            </li>
        </ol>
    </div>
</div>
<!-- End Header -->


<div class="container py-5">

    <div class="row g-4">

        <?php if (!empty($posts)): ?>

            <?php foreach ($posts as $item): ?>

                <?php
                $image = $item['image'] ?? '';

                if (empty($image)) {
                    $image = 'assets/client/img/no-image.png';
                } elseif (
                    !str_contains($image, 'uploads/')
                    && !str_contains($image, 'assets/')
                    && !str_contains($image, 'http')
                ) {
                    $image = 'uploads/posts/' . $image;
                }

                $title = $item['title'] ?? '';

                $excerpt = $item['excerpt']
                    ?? mb_substr(strip_tags($item['content'] ?? ''), 0, 120) . '...';

                $createdAt = $item['created_at'] ?? date('Y-m-d');
                ?>

                <div class="col-md-6 col-lg-4">

                    <div class="card border-0 shadow-sm h-100 post-card-modern">

                        <div class="position-relative">

                            <a href="index.php?page=post-detail&id=<?= $item['id'] ?>">
                                <img src="<?= htmlspecialchars($image) ?>"
                                     class="card-img-top post-image"
                                     alt="<?= htmlspecialchars($title) ?>">
                            </a>

                            <div class="post-date-badge">
                                <span class="day">
                                    <?= date('d', strtotime($createdAt)) ?>
                                </span>

                                <span class="month">
                                    Th<?= date('m', strtotime($createdAt)) ?>
                                </span>
                            </div>

                        </div>

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title mb-3">

                                <a href="index.php?page=post-detail&id=<?= $item['id'] ?>"
                                   class="post-title-link">

                                    <?= htmlspecialchars($title) ?>

                                </a>

                            </h5>

                            <p class="card-text text-muted flex-grow-1">

                                <?= htmlspecialchars($excerpt) ?>

                            </p>

                            <a href="index.php?page=post-detail&id=<?= $item['id'] ?>"
                               class="read-more-link">

                                Xem chi tiết
                                <i class="fas fa-arrow-right ms-2"></i>

                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12">

                <div class="text-center py-5">

                    <i class="fas fa-newspaper fa-4x text-muted mb-4"></i>

                    <h3>Hiện chưa có bài viết nào</h3>

                    <p class="text-muted">
                        Các bài viết sẽ được cập nhật trong thời gian tới.
                    </p>

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>


<style>
.post-card-modern{
    transition:.3s;
    border-radius:18px;
    overflow:hidden;
}

.post-card-modern:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 35px rgba(0,0,0,.12)!important;
}

.post-image{
    width:100%;
    height:260px;
    object-fit:cover;
    transition:.4s;
}

.post-card-modern:hover .post-image{
    transform:scale(1.05);
}

.post-date-badge{
    position:absolute;
    top:15px;
    left:15px;
    width:60px;
    height:60px;
    background:#81c408;
    color:#fff;
    border-radius:12px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    font-weight:700;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}

.post-date-badge .day{
    font-size:18px;
    line-height:1;
}

.post-date-badge .month{
    font-size:12px;
}

.post-title-link{
    color:#222;
    text-decoration:none;
    transition:.3s;
    line-height:1.5;
}

.post-title-link:hover{
    color:#81c408;
}

.read-more-link{
    color:#81c408;
    font-weight:600;
    text-decoration:none;
}

.read-more-link:hover{
    color:#5e9605;
}

.card-text{
    line-height:1.7;
}
</style>