<?php

class CommentController
{
    public function index()
    {
        $title = 'Bình luận';
        $pageTitle = 'Quản lý bình luận';
        $css = 'comments';

        $comments = [
            [
                'id' => 1,
                'user' => 'Nguyen Van A',
                'content' => 'Mô hình rất đẹp, đóng gói kỹ.',
                'post' => 'Mô hình Gundam RX-78-2',
                'date' => '25/05/2026',
                'status' => 'Hiển thị'
            ],
            [
                'id' => 2,
                'user' => 'Tran Minh B',
                'content' => 'Bài viết hướng dẫn rất dễ hiểu.',
                'post' => 'Cách bảo quản mô hình sở thích',
                'date' => '24/05/2026',
                'status' => 'Ẩn'
            ],
            [
                'id' => 3,
                'user' => 'Le Hoang C',
                'content' => 'Minh se mua thu mau nay.',
                'post' => 'Top mô hình One Piece đang mua',
                'date' => '23/05/2026',
                'status' => 'Hiển thị'
            ],
        ];

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/comments/index.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }
}