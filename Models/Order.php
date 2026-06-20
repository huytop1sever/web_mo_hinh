<?php

class Order
{
    private $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
    }

    // Tổng doanh thu (tính từ order_detail)
    public function getTotalRevenue(): float
    {
        $sql = "
            SELECT
                COALESCE(SUM(od.qty * od.price), 0) AS total
            FROM order_detail od

            INNER JOIN orders o ON o.id = od.order_id
        ";


        $stmt = $this->pdo->query($sql);
        $row = $stmt ? $stmt->fetch() : null;

        return (float) (($row['total'] ?? 0));
    }

    public function countOrders(): int
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM orders");
        $row = $stmt ? $stmt->fetch() : null;
        return (int) ($row['total'] ?? 0);
    }

    public function getNewOrders(int $limit = 10): array
    {
        // Lấy các order mới nhất kèm tên khách hàng.
        // Tùy schema của DB, cột tên có thể là: name hoặc customer_name.
        $sql = "
            SELECT
                o.id,
                o.user_id,
                o.status,
                o.payment_status,
                o.created_at,
                u.name AS customer_name,
                COALESCE(SUM(od.qty * od.price), 0) AS total_price

            FROM orders o
            LEFT JOIN users u ON u.id = o.user_id
            LEFT JOIN order_detail od ON od.order_id = o.id
            GROUP BY o.id, o.user_id, o.status, o.payment_status, o.created_at, u.name
            ORDER BY o.created_at DESC, o.id DESC
            LIMIT " . (int) $limit . "
        ";

        $stmt = $this->pdo->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function getPaidOrdersCount(): int
    {
        // payment_status tùy schema có thể là 1/0 hoặc paid/unpaid
        $sql = "
            SELECT COUNT(*) AS total
            FROM orders
            WHERE payment_status IN (1, 'paid')
        ";

        $stmt = $this->pdo->query($sql);
        $row = $stmt ? $stmt->fetch() : null;
        return (int) ($row['total'] ?? 0);
    }

    public function getRevenueForDisplay(): float
    {
        return $this->getTotalRevenue();
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
                p.title AS product_name,
                p.image AS product_image,
                pv.variant_name,
                pv.sku
            FROM order_detail od
            LEFT JOIN products p ON od.product_id = p.id
            LEFT JOIN product_variants pv ON od.product_variant_id = pv.id
            WHERE od.order_id = ?
            ORDER BY od.id ASC
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