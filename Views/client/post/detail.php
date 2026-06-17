<?php
$post = $post ?? [];
$relatedPosts = $relatedPosts ?? [];
?>
<main class="post-detail-page py-5" style="margin-top: 100px; background-color: #fff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="index.php?page=post">Bài viết</a></li>
                        <li class="breadcrumb-item active" aria-current="page text-truncate" style="max-width: 200px;">
                            <?= htmlspecialchars($post['title']) ?>
                        </li>
                    </ol>
                </nav>

                <article class="post-content">
                    <h1 class="display-4 fw-extrabold mb-4" style="color: #1a202c;"><?= htmlspecialchars($post['title']) ?></h1>
                    
                    <div class="d-flex align-items-center gap-4 mb-5 pb-4 border-bottom">
                        <div class="author-info d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">A</div>
                            <span class="fw-bold">Administrator</span>
                        </div>
                        <div class="post-meta-items small text-muted">
                            <span class="me-3"><i class="far fa-calendar me-1"></i> <?= date('d M, Y', strtotime($post['created_at'])) ?></span>
                            <span><i class="far fa-eye me-1"></i> <?= number_format($post['views'] ?? 0) ?> lượt xem</span>
                        </div>
                    </div>

                    <div class="content-body fs-5 lh-base">
                        <div class="modern-excerpt mb-5">
                            <?= htmlspecialchars($post['excerpt'] ?? '') ?>
                        </div>
                        
                        <?php if (!empty($post['image'])): ?>
                        <div class="post-main-image-container mb-5">
                            <img src="assets/client/img/<?= htmlspecialchars($post['image']) ?>" 
                                 class="img-fluid rounded-5 shadow-lg" 
                                 alt="<?= htmlspecialchars($post['title']) ?>">
                        </div>
                        <?php endif; ?>

                        <?= nl2br($post['content']) ?>
                    </div>

                    <!-- Share/Tags -->
                    <div class="border-top border-bottom py-3 my-5 d-flex justify-content-between align-items-center">
                        <div class="tags">
                            <span class="badge bg-light text-dark p-2 me-2">#Figure</span>
                            <span class="badge bg-light text-dark p-2 me-2">#Mô hình</span>
                            <span class="badge bg-light text-dark p-2">#Anime</span>
                        </div>
                        <div class="share">
                            <span class="me-2 fw-bold">Chia sẻ:</span>
                            <a href="#" class="btn btn-light btn-sm rounded-circle"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </article>

                <!-- Related Posts -->
                <?php if (!empty($relatedPosts)): ?>
                <div class="related-posts mt-5 pt-4">
                    <h3 class="fw-bold mb-4">Bài viết liên quan</h3>
                    <div class="row g-4">
                        <?php foreach ($relatedPosts as $rp): ?>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <img src="assets/client/img/<?= htmlspecialchars($rp['image'] ?? 'no-image.png') ?>" 
                                     class="card-img-top" alt="..." style="height: 150px; object-fit: cover;">
                                <div class="card-body p-3">
                                    <h6 class="card-title">
                                        <a href="index.php?page=post-detail&id=<?= $rp['id'] ?>" class="text-dark text-decoration-none">
                                            <?= htmlspecialchars($rp['title']) ?>
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="mt-5 text-center">
                    <a href="index.php?page=post" class="btn btn-primary px-4 py-2 rounded-pill">
                        <i class="fas fa-chevron-left me-2"></i> Quay lại danh sách bài viết
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.fw-extrabold { font-weight: 800; }
.modern-excerpt {
    font-size: 1.4rem;
    color: #4a5568;
    line-height: 1.6;
    font-style: italic;
    position: relative;
    padding-left: 30px;
    border-left: 5px solid #81c408;
}
.content-body { color: #2d3748; }
.content-body p { margin-bottom: 1.5rem; }
.post-main-image-container img {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
}
.related-posts .card-title a {
    font-size: 1rem;
    font-weight: 600;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>