<?php

class Product
{
    private $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
    }

    public function getAll()
    {
        $sql = "
            SELECT 
                p.id,
                p.title AS name,
                p.image,
                p.description,
                p.content,
                p.category_id,
                p.created_at,
                c.name AS category
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            ORDER BY p.id DESC
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $sql = "
            SELECT 
                p.id,
                p.title,
                p.title AS name,
                p.description,
                p.content,
                p.image,
                p.category_id,
                c.name AS category
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "
            INSERT INTO products 
            (title, description, content, image, category_id, created_at, updated_at)
            VALUES 
            (:title, :description, :content, :image, :category_id, NOW(), NOW())
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':content', $data['content']);
        $stmt->bindValue(':image', $data['image']);
        $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function update($data)
    {
        $sql = "
            UPDATE products SET
                title = :title,
                description = :description,
                content = :content,
                image = :image,
                category_id = :category_id,
                updated_at = NOW()
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':content', $data['content']);
        $stmt->bindValue(':image', $data['image']);
        $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}