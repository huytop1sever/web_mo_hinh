<?php

class Post
{
    private $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
        $this->ensureTable();
    }

    private function ensureTable(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                slug VARCHAR(255) NOT NULL UNIQUE,
                excerpt TEXT NULL,
                content LONGTEXT NULL,
                category VARCHAR(100) NOT NULL,
                author VARCHAR(100) NOT NULL DEFAULT 'Admin',
                image VARCHAR(255) NULL,
                status VARCHAR(30) NOT NULL DEFAULT 'draft',
                featured TINYINT(1) NOT NULL DEFAULT 0,
                views INT NOT NULL DEFAULT 0,
                published_at DATE NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";

        $this->pdo->exec($sql);
    }

    public function getAll(string $keyword = '', string $category = '', string $status = ''): array
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
}
