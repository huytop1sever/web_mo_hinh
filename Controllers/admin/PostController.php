<?php

class PostController
{
    private function getCategories(): array
    {
        return ['Gundam', 'Anime Figure', 'Huong dan', 'Tin tuc'];
    }

    private function getStatusText(): array
    {
        return [
            'published' => 'Hien thi',
            'draft' => 'Ban nhap'
        ];
    }

    public function index()
    {
        $title = 'Bai viet';
        $pageTitle = 'Quan ly bai viet';
        $css = 'posts';

        $postModel = new Post();
        $categories = $this->getCategories();
        $statusText = $this->getStatusText();
        $keyword = trim($_GET['keyword'] ?? '');
        $category = $_GET['category'] ?? '';
        $status = $_GET['status'] ?? '';

        $posts = $postModel->getAll($keyword, $category, $status);
        $stats = $postModel->stats();
        $totalPosts = $stats['total'];
        $publishedPosts = $stats['published'];
        $draftPosts = $stats['draft'];
        $featuredPosts = $stats['featured'];

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';
        include_once '../Views/admin/posts/index.php';
        include_once '../Views/admin/layouts/footer.php';
    }

    public function create()
    {
        $title = 'Them bai viet';
        $pageTitle = 'Them bai viet';
        $css = 'posts';
        $categories = $this->getCategories();
        $statusText = $this->getStatusText();

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';
        include_once '../Views/admin/posts/create.php';
        include_once '../Views/admin/layouts/footer.php';
    }

    public function store()
    {
        $postModel = new Post();
        $data = $this->preparePostData($_POST, $postModel);
        $validation = $this->validatePostData($data);

        if ($validation !== true) {
            header('Location: index.php?page=posts&msg=invalid');
            exit;
        }

        $data['image'] = $this->uploadImage();

        $postModel->create($data);

        header('Location: index.php?page=posts&msg=created');
        exit;
    }

    public function edit()
    {
        $title = 'Sua bai viet';
        $pageTitle = 'Sua bai viet';
        $css = 'posts';
        $categories = $this->getCategories();
        $statusText = $this->getStatusText();
        $id = $_GET['id'] ?? 0;

        $postModel = new Post();
        $postEdit = $postModel->find($id);

        if (!$postEdit) {
            header('Location: index.php?page=posts&msg=not_found');
            exit;
        }

        $postEdit['date'] = $postEdit['published_at'] ?? date('Y-m-d');

        include_once '../Views/admin/layouts/header.php';
        include_once '../Views/admin/layouts/sidebar.php';
        include_once '../Views/admin/layouts/navbar.php';
        include_once '../Views/admin/posts/edit.php';
        include_once '../Views/admin/layouts/footer.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? 0;
        $postModel = new Post();
        $oldPost = $postModel->find($id);

        if (!$oldPost) {
            header('Location: index.php?page=posts&msg=not_found');
            exit;
        }

        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            header('Location: index.php?page=posts');
            exit;
        }

        $data = $this->preparePostData($_POST, $postModel, $id);
        $validation = $this->validatePostData($data);

        if ($validation !== true) {
            header('Location: index.php?page=posts&msg=invalid');
            exit;
        }

        $data['image'] = $oldPost['image'] ?? '';

        $newImage = $this->uploadImage();
        if ($newImage !== '') {
            $data['image'] = $newImage;
        }

        $postModel->update($id, $data);

        header('Location: index.php?page=posts&msg=updated');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? 0;

        if (!$id) {
            header('Location: index.php?page=posts&msg=not_found');
            exit;
        }

        $postModel = new Post();
        $oldPost = $postModel->find($id);

        if (!$oldPost) {
            header('Location: index.php?page=posts&msg=not_found');
            exit;
        }

        $postModel->delete($id);

        if (!empty($oldPost['image'])) {
            $filePath = '../' . ltrim($oldPost['image'], '/');
            if (is_file($filePath)) {
                @unlink($filePath);
            }
        }

        header('Location: index.php?page=posts&msg=deleted');
        exit;
    }

    private function preparePostData(array $input, Post $postModel, $ignoreId = null): array
    {
        $title = trim($input['title'] ?? '');
        $slug = trim($input['slug'] ?? '');

        if ($slug === '') {
            $slug = $this->slugify($title);
        } else {
            $slug = $this->slugify($slug);
        }

        $baseSlug = $slug !== '' ? $slug : 'bai-viet';
        $slug = $baseSlug;
        $counter = 2;

        while ($postModel->slugExists($slug, $ignoreId)) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => trim($input['excerpt'] ?? ''),
            'content' => trim($input['content'] ?? ''),
            'category' => trim($input['category'] ?? ''),
            'author' => trim($input['author'] ?? 'Admin'),
            'date' => $input['date'] ?? date('Y-m-d'),
            'status' => $input['status'] ?? 'draft',
            'featured' => !empty($input['featured']) ? 1 : 0,
        ];
    }

    private function slugify(string $text): string
    {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        $text = strtolower($text ?: '');
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);

        return trim($text, '-');
    }

    private function validatePostData(array $data)
    {
        $requiredKeys = ['title', 'excerpt', 'content', 'category', 'author', 'status'];
        foreach ($requiredKeys as $key) {
            if (!isset($data[$key]) || trim((string) $data[$key]) === '') {
                return false;
            }
        }

        $allowedStatus = ['published', 'draft'];
        if (!in_array($data['status'], $allowedStatus, true)) {
            return false;
        }

        return true;
    }

    private function uploadImage(): string
    {
        if (empty($_FILES['image']['name'])) {
            return '';
        }

        $uploadDir = '../uploads/posts/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $allowed, true)) {
            return '';
        }

        $fileName = time() . '_' . uniqid() . '.' . $extension;
        $targetPath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            return '';
        }

        return 'uploads/posts/' . $fileName;
    }
}
