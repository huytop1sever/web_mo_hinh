<?php

require_once 'Models/Post.php';

class PostController
{
    public function index()
    {
        $postModel = new Post();
        // Lấy danh sách tất cả bài viết đã xuất bản
        $posts = $postModel->getAll('', '', 'published');

        require_once 'Views/client/post/index.php';
    }

    public function detail()
    {
        $slug = isset($_GET['slug']) ? trim((string)$_GET['slug']) : '';

        if ($slug === '') {
            header('Location: index.php?page=post');
            exit;
        }

        $postModel = new Post();
        $post = $postModel->findBySlug($slug);

        if (!$post) {
            header('Location: index.php?page=post');
            exit;
        }

        // Tăng lượt xem và lấy bài viết liên quan
        $postModel->increaseView((int) $post['id']);
        $relatedPosts = $postModel->getRelated((int) $post['id'], 3);

        require_once 'Views/client/post/detail.php';
    }
}

