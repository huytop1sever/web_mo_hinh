<?php

class PostController
{
    private function getPosts()
    {
        return [
            [
                'id' => 1,
                'title' => 'Mô hình Gundam RX-78-2',
                'category' => 'Gundam',
                'author' => 'Admin',
                'date' => '25/05/2026',
                'status' => 'Hiển thị'
            ],
            [
                'id' => 2,
                'title' => 'Top mô hình One Piece đang mua',
                'category' => 'Anime Figure',
                'author' => 'Admin',
                'date' => '24/05/2026',
                'status' => 'Ẩn'
            ],
            [
                'id' => 3,
                'title' => 'Cách bảo quản mô hình sở thích',
                'category' => 'Hướng dẫn',
                'author' => 'Admin',
                'date' => '23/05/2026',
                'status' => 'Hiển thị'
            ],
        ];
    }

    public function index()
    {
        $title = 'Bai viet';
        $pageTitle = 'Quản lý bài viết';
        $css = 'posts';

        $posts = $this->getPosts();

        if (!empty($_GET['delete_id'])) {
            $deleteId = $_GET['delete_id'];

            $posts = array_filter($posts, function ($post) use ($deleteId) {
                return $post['id'] != $deleteId;
            });
        }

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/posts/index.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    public function create()
    {
        $title = 'Thêm bài viết';
        $pageTitle = 'Thêm bài viết';
        $css = 'posts';

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/posts/create.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    public function edit()
    {
        $title = 'Sửa bài viết';
        $pageTitle = 'Sửa bài viết';
        $css = 'posts';

        $id = $_GET['id'] ?? 1;

        $posts = $this->getPosts();

        $postEdit = null;

        foreach ($posts as $post) {
            if ($post['id'] == $id) {
                $postEdit = $post;
                break;
            }
        }

        if ($postEdit === null) {
            $postEdit = [
                'id' => '',
                'title' => '',
                'category' => '',
                'author' => '',
                'date' => '',
                'status' => 'Hiển thị',
                'content' => ''
            ];
        }

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/posts/edit.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? '';

        header('Location: index.php?page=posts&delete_id=' . $id);
        exit;
    }
}