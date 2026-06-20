<?php

class Category
{
    private $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $result = $this->pdo->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $id = (int)$id;

        $sql = "SELECT * FROM categories WHERE id = $id";
        $result = $this->pdo->query($sql);

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $name = trim($data['name'] ?? '');
        $description = trim($data['description'] ?? '');
        $status = trim($data['status'] ?? 'Hiển thị');

        $sql = "
            INSERT INTO categories (name, description, status)
            VALUES (:name, :description, :status)
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':status', $status);
        $stmt->execute();

        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, array $data)
    {
        $id = (int)$id;
        $name = trim($data['name'] ?? '');
        $description = trim($data['description'] ?? '');
        $status = trim($data['status'] ?? 'Hiển thị');

        $sql = "
            UPDATE categories
            SET name = :name,
                description = :description,
                status = :status
            WHERE id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':status', $status);

        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $id = (int)$id;

        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}

