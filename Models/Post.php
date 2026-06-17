<?php

class Post
{
    private $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
    }

    public function getAll(string $keyword = '', string $category = '', string $status = 'published'): array
    {
        $sql = "SELECT * FROM posts WHERE 1";
        $params = [];
        
        if ($keyword !== '') {
            $sql .= " AND (title LIKE :keyword OR excerpt LIKE :keyword OR content LIKE :keyword)";
            $params[':keyword'] = '%' . $keyword . '%';
        }

        if ($category !== '') {
            $sql .= " AND category = :category";
            $params[':category'] = $category;
        }

        if ($status !== '') {
            $sql .= " AND status = :status";
            $params[':status'] = $status;
        }

        $sql .= " ORDER BY id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function increaseView($id): void
    {
        $sql = "UPDATE posts SET views = views + 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO posts
            (title, slug, excerpt, content, category, author, image, status, featured, published_at)
            VALUES
            (:title, :slug, :excerpt, :content, :category, :author, :image, :status, :featured, :published_at)
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($this->bindData($data));
    }

    public function update($id, array $data): bool
    {
        $sql = "
            UPDATE posts SET
                title = :title,
                slug = :slug,
                excerpt = :excerpt,
                content = :content,
                category = :category,
                author = :author,
                image = :image,
                status = :status,
                featured = :featured,
                published_at = :published_at
            WHERE id = :id
        ";

        $params = $this->bindData($data);
        $params[':id'] = $id;

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($params);
    }

    public function delete($id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = ?");

        return $stmt->execute([$id]);
    }

    public function stats(): array
    {
        return [
            'total' => (int) $this->pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn(),
            'published' => (int) $this->pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'published'")->fetchColumn(),
            'draft' => (int) $this->pdo->query("SELECT COUNT(*) FROM posts WHERE status = 'draft'")->fetchColumn(),
            'featured' => (int) $this->pdo->query("SELECT COUNT(*) FROM posts WHERE featured = 1")->fetchColumn(),
        ];
    }

    public function slugExists(string $slug, $ignoreId = null): bool
    {
        $sql = "SELECT COUNT(*) FROM posts WHERE slug = :slug";
        $params = [':slug' => $slug];

        if ($ignoreId) {
            $sql .= " AND id <> :id";
            $params[':id'] = $ignoreId;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }

    private function bindData(array $data): array
    {
        return [
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':excerpt' => $data['excerpt'] ?? '',
            ':content' => $data['content'] ?? '',
            ':category' => $data['category'],
            ':author' => $data['author'] ?? 'Admin',
            ':image' => $data['image'] ?? '',
            ':status' => $data['status'] ?? 'draft',
            ':featured' => !empty($data['featured']) ? 1 : 0,
            ':published_at' => $data['date'] ?? date('Y-m-d'),
        ];
    }

    public function getRelated(int $id, int $limit = 3): array
    {
        $post = $this->find($id);
        if (!$post) return [];

        $sql = "SELECT * FROM posts 
                WHERE category = :category 
                AND id <> :id 
                AND status = 'published' 
                ORDER BY created_at DESC 
                LIMIT :limit";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':category', $post['category']);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
