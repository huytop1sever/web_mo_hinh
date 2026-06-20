<?php

class User
{
    private $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
    }

    public function getAllTotal(): int
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM users");
        $row = $stmt ? $stmt->fetch() : null;
        return (int) ($row['total'] ?? 0);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }


    public function find($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO users (name, email, phone, password, role, status)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['role'],
            $data['status']
        ]);
    }

    public function register($data)
    {
        $sql = "INSERT INTO users (name, email, phone, password, role, status)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            'client',
            1
        ]);
    }

    public function update($id, $data)
    {
        if (!empty($data['password'])) {
            $sql = "UPDATE users 
                    SET name = ?, email = ?, phone = ?, password = ?, role = ?, status = ?
                    WHERE id = ?";

            $params = [
                $data['name'],
                $data['email'],
                $data['phone'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $data['role'],
                $data['status'],
                $id
            ];
        } else {
            $sql = "UPDATE users 
                    SET name = ?, email = ?, phone = ?, role = ?, status = ?
                    WHERE id = ?";

            $params = [
                $data['name'],
                $data['email'],
                $data['phone'],
                $data['role'],
                $data['status'],
                $id
            ];
        }

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function updatePasswordByEmail($email, $password)
    {
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            password_hash($password, PASSWORD_DEFAULT),
            $email
        ]);
    }

    public function lock($id)
    {
        $sql = "UPDATE users SET status = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function unlock($id)
    {
        $sql = "UPDATE users SET status = 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}