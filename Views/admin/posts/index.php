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

```
<?php if (!empty($_GET['msg'])): ?>
    <div class="post-alert">
        <?php
        $messages = [
            'created' => 'Đã thêm bài viết thành công.',
            'updated' => 'Đã cập nhật bài viết thành công.',
            'deleted' => 'Đã xoá bài viết thành công.',
            'not_found' => 'Không tìm thấy bài viết.'
        ];

        echo htmlspecialchars($messages[$_GET['msg']] ?? '');
        ?>
    </div>
<?php endif; ?>

<div class="post-stats">

    <div class="post-stat">
        <span>Tổng bài viết</span>
        <strong><?= number_format($totalPosts) ?></strong>
        <i class='bx bx-news'></i>
    </div>

    <div class="post-stat">
        <span>Đang hiển thị</span>
        <strong><?= number_format($publishedPosts) ?></strong>
        <i class='bx bx-show'></i>
    </div>

    <div class="post-stat">
        <span>Bản nháp</span>
        <strong><?= number_format($draftPosts) ?></strong>
        <i class='bx bx-edit-alt'></i>
    </div>

    <div class="post-stat">
        <span>Nổi bật</span>
        <strong><?= number_format($featuredPosts) ?></strong>
        <i class='bx bx-star'></i>
    </div>

</div>

<div class="box posts-table-box">

    <div class="box-title">
        <div>
            <h2>Danh sách bài viết</h2>
            <p>Quản lý nội dung bài viết của website.</p>
        </div>

        <a href="index.php?page=post-create" class="btn-primary">
            <i class='bx bx-plus'></i>
            <span>Thêm bài viết</span>
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
                placeholder="Tìm kiếm bài viết...">
        </label>

        <select name="category">
            <option value="">Tất cả danh mục</option>

            <?php foreach ($categories as $item): ?>

                <?php
                $categoryName = is_array($item)
                    ? ($item['name'] ?? '')
                    : $item;
                ?>

                <option
                    value="<?= htmlspecialchars($categoryName) ?>"
                    <?= $category == $categoryName ? 'selected' : '' ?>>

                    <?= htmlspecialchars($categoryName) ?>

                </option>

            <?php endforeach; ?>
        </select>

        <select name="status">
            <option value="">Tất cả trạng thái</option>

            <?php foreach ($statusText as $key => $text): ?>
                <option
                    value="<?= $key ?>"
                    <?= $status == $key ? 'selected' : '' ?>>

                    <?= htmlspecialchars($text) ?>

                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn-primary">
            <i class='bx bx-filter-alt'></i>
            <span>Lọc</span>
        </button>

        <a href="index.php?page=posts" class="btn-reset">
            Làm mới
        </a>

    </form>

    <div class="table-wrapper">

        <table class="post-table">

            <thead>
                <tr>
                    <th>Bài viết</th>
                    <th>Danh mục</th>
                    <th>Tác giả</th>
                    <th>Ngày đăng</th>
                    <th>Lượt xem</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
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

                                        <strong>
                                            <?= htmlspecialchars($post['title']) ?>
                                        </strong>

                                        <?php if (!empty($post['featured'])): ?>
                                            <span class="featured-badge">
                                                <i class='bx bxs-star'></i>
                                                Nổi bật
                                            </span>
                                        <?php endif; ?>

                                    </div>

                                    <small>
                                        /<?= htmlspecialchars($post['slug']) ?>
                                    </small>

                                    <p>
                                        <?= htmlspecialchars($post['excerpt']) ?>
                                    </p>

                                </div>

                            </div>

                        </td>

                        <td>
                            <span class="category-pill">
                                <?= htmlspecialchars($post['category']) ?>
                            </span>
                        </td>

                        <td>
                            <?= htmlspecialchars($post['author']) ?>
                        </td>

                        <td>
                            <?= !empty($post['created_at']) ? date('d/m/Y', strtotime($post['created_at'])) : '-' ?>
                        </td>

                        <td>
                            <?= number_format($post['views'] ?? 0) ?>
                        </td>

                        <td>
                            <span class="status post-status <?= htmlspecialchars($post['status']) ?>">
                                <?= htmlspecialchars($statusText[$post['status']] ?? $post['status']) ?>
                            </span>
                        </td>

                        <td>

                            <div class="table-actions">

                                <a href="../index.php?page=post-detail&id=<?= (int)$post['id'] ?>"
                                   target="_blank"
                                   class="action-btn view">
                                    <i class='bx bx-show'></i>
                                </a>

                                <a href="index.php?page=post-edit&id=<?= (int)$post['id'] ?>"
                                   class="action-btn edit">
                                    <i class='bx bx-edit'></i>
                                </a>

                                <a href="index.php?page=post-delete&id=<?= (int)$post['id'] ?>"
                                   class="action-btn delete"
                                   onclick="return confirm('Bạn có chắc muốn xoá bài viết này?')">
                                    <i class='bx bx-trash'></i>
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>
```

</div>
