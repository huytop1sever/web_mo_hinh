<?php $posts = $posts ?? []; ?>

<div class="posts-page">

    <div class="box">

        <div class="box-title">
            <h2>Danh sách bài viết</h2>

            <a href="index.php?page=post-create" class="btn-primary">
                <i class='bx bx-plus'></i>
                <span>Thêm bài viết</span>
            </a>
        </div>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Tác giả</th>
                        <th>Ngày đăng</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td>#<?= $post['id'] ?></td>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['category'] ?></td>
                            <td><?= $post['author'] ?></td>
                            <td><?= $post['date'] ?></td>
                            <td>
                                <span class="status <?= $post['status'] === 'Ẩn' ? 'cancelled' : 'confirmed' ?>">
                                    <?= $post['status'] ?>
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">

                                    <a href="index.php?page=post-edit&id=<?= $post['id'] ?>" class="action-btn edit" title="Sửa">
                                        <i class='bx bx-edit'></i>
                                    </a>

                                    <a href="index.php?page=post-delete&id=<?= $post['id'] ?>" 
                                       class="action-btn delete" 
                                       title="Xóa"
                                       onclick="return confirm('Ban co chac muon xoa bai viet nay?')">
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

</div>