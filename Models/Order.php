<?php

class Order
{
    private $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM orders ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getOrderDetails($orderId)
    {
        $sql = "
            SELECT 
                od.*,
                p.title AS product_name
            FROM order_detail od
            LEFT JOIN products p ON od.product_id = p.id
            WHERE od.order_id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId]);

        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}