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

    public function getByUserId($userId)
{
    $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$userId]);

    return $stmt->fetchAll();
}

public function countByUserId($userId)
{
    $sql = "SELECT COUNT(*) AS total FROM orders WHERE user_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$userId]);

    $row = $stmt->fetch();

    return $row['total'] ?? 0;
}

    public function createOrderWithItems($orderData, $items)
    {
        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO orders (user_id, name, phone, address, total_price, payment_method, payment_status, status, note, created_at, updated_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $orderData['user_id'],
                $orderData['name'],
                $orderData['phone'],
                $orderData['address'],
                $orderData['total_price'],
                $orderData['payment_method'],
                $orderData['payment_status'] ?? 'unpaid',
                $orderData['status'] ?? 'pending',
                $orderData['note'] ?? ''
            ]);

            $orderId = $this->pdo->lastInsertId();

            $detailSql = "INSERT INTO order_detail (order_id, product_id, product_variant_id, qty, price, total_price, created_at, updated_at)
                          VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $detailStmt = $this->pdo->prepare($detailSql);

            foreach ($items as $productId => $item) {
                $productId = (int)$productId;
                if (is_array($item)) {
                    $qty = (int)($item['qty'] ?? 0);
                    $price = isset($item['price']) ? (float)$item['price'] : null;
                } else {
                    $qty = (int)$item;
                    $price = null;
                }

                if ($price === null) {
                    $pstmt = $this->pdo->prepare("SELECT price, sale_price FROM products WHERE id = ?");
                    $pstmt->execute([$productId]);
                    $prow = $pstmt->fetch();
                    $price = ($prow && isset($prow['sale_price']) && $prow['sale_price'] > 0) ? $prow['sale_price'] : ($prow['price'] ?? 0);
                }

                $totalPrice = $price * $qty;
                $detailStmt->execute([$orderId, $productId, null, $qty, $price, $totalPrice]);
            }

            $this->pdo->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            error_log('Create order error: ' . $e->getMessage());
            return false;
        }
    }
}