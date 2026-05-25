<?php $comments = $comments ?? []; ?>

<div class="box">

    <div class="box-title">
        <h2>Danh sách bình luận</h2>
    </div>

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Người dùng</th>
                    <th>Nội dung</th>
                    <th>Bài viết</th>
                    <th>Ngày đăng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td>#<?= $comment['id'] ?></td>
                        <td><?= $comment['user'] ?></td>
                        <td><?= $comment['content'] ?></td>
                        <td><?= $comment['post'] ?></td>
                        <td><?= $comment['date'] ?></td>
                        <td>
                            <span class="status <?= $comment['status'] === 'An' ? 'cancelled' : 'confirmed' ?>">
                                <?= $comment['status'] ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="#" class="action-btn edit" title="Sua">
                                    <i class='bx bx-edit'></i>
                                </a>

                                <a href="#" class="action-btn delete" title="Xoa">
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