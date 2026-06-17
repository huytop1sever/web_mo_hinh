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
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id <= 0) {
            header('Location: index.php?page=post');
            exit;
        }

        $postModel = new Post();
        $post = $postModel->find($id);

        if (!$post) {
            header('Location: index.php?page=post');
            exit;
        }

        // Tăng lượt xem và lấy bài viết liên quan
        $postModel->increaseView($id);
        $relatedPosts = $postModel->getRelated($id, 3);

        require_once 'Views/client/post/detail.php';
    }
}