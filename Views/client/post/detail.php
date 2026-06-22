<?php
$post = $post ?? [];
$relatedPosts = $relatedPosts ?? [];

function postImagePath($image)
{
    if (empty($image)) {
        return 'assets/client/img/no-image.png';
    }

    if (
        str_contains($image, 'uploads/')
        || str_contains($image, 'assets/')
        || str_contains($image, 'http')
    ) {
        return $image;
    }

    return 'uploads/posts/' . $image;
}

$postImage = postImagePath($post['image'] ?? '');
?>

<main class="post-detail-page py-5" style="margin-top:100px;background-color:#fff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">Trang chủ</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="index.php?page=post">Bài viết</a>
                        </li>

                        <li class="breadcrumb-item active text-truncate"
                            aria-current="page"
                            style="max-width:200px;">
                            <?= htmlspecialchars($post['title'] ?? '') ?>
                        </li>
                    </ol>
                </nav>

                <article class="post-content">

                    <h1 class="display-4 fw-extrabold mb-4" style="color:#1a202c;">
                        <?= htmlspecialchars($post['title'] ?? '') ?>
                    </h1>

                    <div class="d-flex align-items-center gap-4 mb-5 pb-4 border-bottom flex-wrap">
                        <div class="author-info d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                 style="width:40px;height:40px;">
                                A
                            </div>

                            <span class="fw-bold">Administrator</span>
                        </div>

                        <div class="post-meta-items small text-muted">
                            <span class="me-3">
                                <i class="far fa-calendar me-1"></i>
                                <?= !empty($post['created_at']) ? date('d/m/Y', strtotime($post['created_at'])) : '' ?>
                            </span>

                            <span>
                                <i class="far fa-eye me-1"></i>
                                <?= number_format($post['views'] ?? 0) ?> lượt xem
                            </span>
                        </div>
                    </div>

                    <div class="content-body fs-5 lh-base">

                        <?php if (!empty($post['excerpt'])): ?>
                            <div class="modern-excerpt mb-5">
                                <?= htmlspecialchars($post['excerpt']) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($post['content'])): ?>
                            <?php
                                $contentRaw = is_string($post['content']) ? $post['content'] : '';
                                $contentMaxLen = 350;
                                $contentShow = mb_strlen($contentRaw, 'UTF-8') > $contentMaxLen
                                    ? mb_substr($contentRaw, 0, $contentMaxLen, 'UTF-8') . '...'
                                    : $contentRaw;
                                $contentIsLong = mb_strlen($contentRaw, 'UTF-8') > $contentMaxLen;
                            ?>

                            <div class="post-content-excerpt" data-post-content="<?= htmlspecialchars($contentRaw) ?>">
                                <div class="post-content-short">
                                    <?= nl2br(htmlspecialchars($contentShow)) ?>
                                </div>

                                <?php if ($contentIsLong): ?>
                                    <button type="button" class="btn-content-toggle" data-action="show" aria-expanded="false">
                                        ...
                                    </button>


                                    <div class="post-content-full" style="display:none;">

                                        <?= nl2br(htmlspecialchars($contentRaw)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($post['image'])): ?>
                            <div class="post-main-image-container mb-5">
                                <img src="<?= htmlspecialchars($postImage) ?>"
                                     class="img-fluid rounded-5 shadow-lg"
                                     alt="<?= htmlspecialchars($post['title'] ?? '') ?>">
                            </div>
                        <?php endif; ?>

                        <div class="post-content-text" style="display:none;">
                            <?= nl2br($post['content'] ?? '') ?>
                        </div>

                    </div>


                    <div class="border-top border-bottom py-3 my-5 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="tags">
                            <span class="badge bg-light text-dark p-2 me-2">#Figure</span>
                            <span class="badge bg-light text-dark p-2 me-2">#Mô hình</span>
                            <span class="badge bg-light text-dark p-2">#Anime</span>
                        </div>

                        <div class="share">
                            <span class="me-2 fw-bold">Chia sẻ:</span>
                            <a href="#" class="btn btn-light btn-sm rounded-circle">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>

                </article>

                <?php if (!empty($relatedPosts)): ?>
                    <div class="related-posts mt-5 pt-4">
                        <h3 class="fw-bold mb-4">Bài viết liên quan</h3>

                        <div class="row g-4">
                            <?php foreach ($relatedPosts as $rp): ?>
                                <?php
                                $rpImage = postImagePath($rp['image'] ?? '');
                                ?>

                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100 related-card">

                                        <a href="index.php?page=post-detail&id=<?= htmlspecialchars($rp['id']) ?>">
                                            <img src="<?= htmlspecialchars($rpImage) ?>"
                                                 class="card-img-top"
                                                 alt="<?= htmlspecialchars($rp['title'] ?? '') ?>"
                                                 style="height:150px;object-fit:cover;">
                                        </a>

                                        <div class="card-body p-3">
                                            <h6 class="card-title">
                                                <a href="index.php?page=post-detail&id=<?= htmlspecialchars($rp['id']) ?>"
                                                   class="text-dark text-decoration-none">
                                                    <?= htmlspecialchars($rp['title'] ?? '') ?>
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
                        <i class="fas fa-chevron-left me-2"></i>
                        Quay lại danh sách bài viết
                    </a>
                </div>

            </div>
        </div>
    </div>
</main>

<style>
.fw-extrabold{
    font-weight:800;
}

.modern-excerpt{
    font-size:1.4rem;
    color:#4a5568;
    line-height:1.6;
    font-style:italic;
    position:relative;
    padding-left:30px;
    border-left:5px solid #81c408;
}

.content-body{
    color:#2d3748;
}

.content-body p{
    margin-bottom:1.5rem;
}

.post-main-image-container img{
    width:100%;
    max-height:500px;
    object-fit:cover;
}

.post-content-text img{
    max-width:100%;
    height:auto;
    border-radius:18px;
    margin:20px 0;
}

.related-card{
    border-radius:16px;
    overflow:hidden;
    transition:.3s;
}

.related-card:hover{
    transform:translateY(-5px);
    box-shadow:0 12px 30px rgba(0,0,0,.12)!important;
}

.related-posts .card-title a{
    font-size:1rem;
    font-weight:600;
    display:-webkit-box;
    /* -webkit-line-clamp:2; */
    -webkit-box-orient:vertical;
    overflow:hidden;
}

.related-posts .card-title a:hover{
    color:#81c408!important;
}

.post-content-excerpt .btn-content-toggle{
    background:#f59e0b;
    color:#fff;
    border:none;
    border-radius:10px;
    padding:8px 14px;
    font-weight:700;
    cursor:pointer;
    transition:.2s ease;
}

.post-content-excerpt .btn-content-toggle:hover{
    background:#d97706;
}

.post-content-excerpt .post-content-full{
    color:#2d3748;
}

 .post-content-excerpt .post-content-short{
    color:#2d3748;
}

.post-content-excerpt .modern-excerpt-readmore{
    display:inline-block;
    margin-top:8px;
    font-size:13px;
    color:#81c408;
    font-weight:700;
}
</style>


<script>
(function(){
  function onClick(e){
    var btn = e.target.closest('.btn-content-toggle');
    if(!btn) return;
    var wrap = btn.closest('.post-content-excerpt');
    if(!wrap) return;
    var full = wrap.querySelector('.post-content-full');
    if(!full) return;

    var action = btn.getAttribute('data-action') || 'show';
    if(action === 'show'){
      full.style.display = 'block';
      btn.setAttribute('data-action','hide');
      btn.setAttribute('aria-expanded','true');
      btn.textContent = 'Ẩn';
    }else{
      full.style.display = 'none';
      btn.setAttribute('data-action','show');
      btn.setAttribute('aria-expanded','false');
      btn.textContent = 'Show';
    }


  }
  document.addEventListener('click', onClick);
})();
</script>

