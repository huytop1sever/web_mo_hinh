<?php

require_once '../config/database.php';

class Product
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
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
                c.name AS category
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            ORDER BY p.id DESC
        ";

        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";

        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id)
    {
        $id = (int)$id;

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
            WHERE p.id = $id
        ";

        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    public function create($data)
    {
        $title = $this->conn->real_escape_string($data['title']);
        $description = $this->conn->real_escape_string($data['description']);
        $content = $this->conn->real_escape_string($data['content']);
        $image = $this->conn->real_escape_string($data['image']);
        $category_id = (int)$data['category_id'];

        $sql = "
            INSERT INTO products 
            (title, description, content, image, category_id, created_at, updated_at)
            VALUES 
            ('$title', '$description', '$content', '$image', $category_id, NOW(), NOW())
        ";

        return $this->conn->query($sql);
    }

    public function update($data)
    {
        $id = (int)$data['id'];
        $title = $this->conn->real_escape_string($data['title']);
        $description = $this->conn->real_escape_string($data['description']);
        $content = $this->conn->real_escape_string($data['content']);
        $image = $this->conn->real_escape_string($data['image']);
        $category_id = (int)$data['category_id'];

        $sql = "
            UPDATE products SET
                title = '$title',
                description = '$description',
                content = '$content',
                image = '$image',
                category_id = $category_id,
                updated_at = NOW()
            WHERE id = $id
        ";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;

        $sql = "DELETE FROM products WHERE id = $id";

        return $this->conn->query($sql);
    }
}