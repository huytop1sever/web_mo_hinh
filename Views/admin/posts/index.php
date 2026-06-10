<?php
$posts = $posts ?? [];
$categories = $categories ?? [];
$statusText = $statusText ?? [];
$keyword = $keyword ?? '';
$category = $category ?? '';
$status = $status ?? '';
$totalPosts = $totalPosts ?? 0;
$publishedPosts = $publishedPosts ?? 0;
$draftPosts = $draftPosts ?? 0;
$featuredPosts = $featuredPosts ?? 0;
?>

<div class="posts-page">

    <?php if (!empty($_GET['msg'])): ?>
        <div class="post-alert">
            <?php
            $messages = [
                'created' => 'Da them bai viet thanh cong.',
                'updated' => 'Da cap nhat bai viet thanh cong.',
                'deleted' => 'Da xoa bai viet thanh cong.',
                'not_found' => 'Khong tim thay bai viet.'
            ];

            echo htmlspecialchars($messages[$_GET['msg']] ?? '');
            ?>
        </div>
    <?php endif; ?>

    <div class="post-stats">
        <div class="post-stat">
            <span>T&#7893;ng b&#224;i vi&#7871;t</span>
            <strong><?= number_format((int) $totalPosts, 0, ',', '.') ?></strong>
            <i class='bx bx-news'></i>
        </div>

        <div class="post-stat">
            <span>&#272;ang hi&#7875;n th&#7883;</span>
            <strong><?= number_format((int) $publishedPosts, 0, ',', '.') ?></strong>
            <i class='bx bx-show'></i>
        </div>

        <div class="post-stat">
            <span>B&#7843;n nh&#225;p</span>
            <strong><?= number_format((int) $draftPosts, 0, ',', '.') ?></strong>
            <i class='bx bx-edit-alt'></i>
        </div>

        <div class="post-stat">
            <span>N&#7893;i b&#7853;t</span>
            <strong><?= number_format((int) $featuredPosts, 0, ',', '.') ?></strong>
            <i class='bx bx-star'></i>
        </div>
    </div>

    <div class="box posts-table-box">
        <div class="box-title">
            <div>
                <h2>Danh s&#225;ch b&#224;i vi&#7871;t</h2>
                <p>Qu&#7843;n l&#253; n&#7897;i dung, tr&#7841;ng th&#225;i hi&#7875;n th&#7883; v&#224; b&#224;i n&#7893;i b&#7853;t.</p>
            </div>

            <a href="index.php?page=post-create" class="btn-primary">
                <i class='bx bx-plus'></i>
                <span>Th&#234;m b&#224;i vi&#7871;t</span>
            </a>
        </div>

        <form method="get" action="index.php" class="post-filter">
            <input type="hidden" name="page" value="posts">

            <label class="post-search">
                <i class='bx bx-search'></i>
                <input
                    type="text"
                    name="keyword"
                    value="<?= htmlspecialchars($keyword) ?>"
                    placeholder="T&#236;m ti&#234;u &#273;&#7873;, m&#244; t&#7843;...">
            </label>

            <select name="category">
                <option value="">T&#7845;t c&#7843; danh m&#7909;c</option>
                <?php foreach ($categories as $item): ?>
                    <option value="<?= htmlspecialchars($item) ?>" <?= $category === $item ? 'selected' : '' ?>>
                        <?= htmlspecialchars($item) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="status">
                <option value="">T&#7845;t c&#7843; tr&#7841;ng th&#225;i</option>
                <?php foreach ($statusText as $key => $text): ?>
                    <option value="<?= htmlspecialchars($key) ?>" <?= $status === $key ? 'selected' : '' ?>>
                        <?= htmlspecialchars($text) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn-primary">
                <i class='bx bx-filter-alt'></i>
                <span>L&#7885;c</span>
            </button>

            <a href="index.php?page=posts" class="btn-reset">
                L&#224;m m&#7899;i
            </a>
        </form>

        <div class="table-wrapper">
            <table class="post-table">
                <thead>
                    <tr>
                        <th>B&#224;i vi&#7871;t</th>
                        <th>Danh m&#7909;c</th>
                        <th>T&#225;c gi&#7843;</th>
                        <th>Ng&#224;y &#273;&#259;ng</th>
                        <th>L&#432;&#7907;t xem</th>
                        <th>Tr&#7841;ng th&#225;i</th>
                        <th>Thao t&#225;c</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td>
                                <div class="post-cell">
                                    <?php if (!empty($post['image'])): ?>
                                        <img
                                            src="../<?= htmlspecialchars($post['image']) ?>"
                                            alt="<?= htmlspecialchars($post['title']) ?>"
                                            class="post-thumb">
                                    <?php else: ?>
                                        <div class="post-thumb post-thumb-empty">
                                            <i class='bx bx-image'></i>
                                        </div>
                                    <?php endif; ?>

                                    <div class="post-cell-info">
                                        <div class="post-title-line">
                                            <strong><?= htmlspecialchars($post['title']) ?></strong>
                                            <?php if (!empty($post['featured'])): ?>
                                                <span class="featured-badge">
                                                    <i class='bx bxs-star'></i>
                                                    N&#7893;i b&#7853;t
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <small>/<?= htmlspecialchars($post['slug']) ?></small>
                                        <p><?= htmlspecialchars($post['excerpt']) ?></p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="category-pill"><?= htmlspecialchars($post['category']) ?></span>
                            </td>

                            <td><?= htmlspecialchars($post['author']) ?></td>

                            <?php
                                $postDate = $post['published_at'] ?? $post['date'] ?? $post['created_at'] ?? '';
                            ?>
                            <td>
                                <?= $postDate ? date('d/m/Y', strtotime($postDate)) : '-' ?>
                            </td>

                            <td><?= number_format((int) $post['views'], 0, ',', '.') ?></td>

                            <td>
                                <span class="status post-status <?= htmlspecialchars($post['status']) ?>">
                                    <?= htmlspecialchars($statusText[$post['status']] ?? $post['status']) ?>
                                </span>
                            </td>

                            <td>
                                <div class="table-actions">
                                    <a href="#" class="action-btn view" title="Xem nhanh">
                                        <i class='bx bx-show'></i>
                                    </a>

                                    <a href="index.php?page=post-edit&id=<?= (int) $post['id'] ?>" class="action-btn edit" title="S&#7917;a">
                                        <i class='bx bx-edit'></i>
                                    </a>

                                    <a
                                        href="index.php?page=post-delete&id=<?= (int) $post['id'] ?>"
                                        class="action-btn delete"
                                        title="X&#243;a"
                                        onclick="return confirm('Ban co chac muon xoa bai viet nay?')">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($posts)): ?>
                        <tr>
                            <td colspan="7" class="empty-posts">
                                <i class='bx bx-file-find'></i>
                                <strong>Kh&#244;ng t&#236;m th&#7845;y b&#224;i vi&#7871;t</strong>
                                <span>Th&#7917; &#273;&#7893;i t&#7915; kh&#243;a ho&#7863;c b&#7897; l&#7885;c.</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
