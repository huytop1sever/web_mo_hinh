<?php

class Cart
{
    private $pdo;
    private $userId;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
        $this->userId = $_SESSION['user']['id'] ?? null;
    }

    public function getItems()
    {
        if (!$this->userId) {
            return [];
        }

        $sql = "
            SELECT 
                c.id,
                c.user_id,
                c.product_id,
                c.product_variant_id,
                c.qty,

                p.title AS product_name,
                p.image AS product_image,

                pv.variant_name,
                pv.sku,
                pv.price,
                pv.sale_price,
                pv.stock

            FROM carts c
            INNER JOIN products p ON p.id = c.product_id
            LEFT JOIN product_variants pv ON pv.id = c.product_variant_id
            WHERE c.user_id = ?
            ORDER BY c.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($productId, $qty = 1, $variantId = null)
    {
        if (!$this->userId) {
            return false;
        }

        $productId = (int)$productId;
        $qty = (int)$qty;
        $variantId = $variantId ? (int)$variantId : null;

        $sql = "
            SELECT id, qty 
            FROM carts 
            WHERE user_id = ? 
              AND product_id = ? 
              AND (
                    product_variant_id = ? 
                    OR (product_variant_id IS NULL AND ? IS NULL)
                  )
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $this->userId,
            $productId,
            $variantId,
            $variantId
        ]);

        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cart) {
            $sql = "
                UPDATE carts 
                SET qty = qty + ?, updated_at = NOW()
                WHERE id = ?
            ";

            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$qty, $cart['id']]);
        }

        $sql = "
            INSERT INTO carts 
                (user_id, product_id, product_variant_id, qty, created_at, updated_at)
            VALUES 
                (?, ?, ?, ?, NOW(), NOW())
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $this->userId,
            $productId,
            $variantId,
            $qty
        ]);
    }

    public function update($productId, $qty, $variantId = null)
    {
        if (!$this->userId) {
            return false;
        }

        $productId = (int)$productId;
        $qty = (int)$qty;
        $variantId = $variantId ? (int)$variantId : null;

        $sql = "
            UPDATE carts
            SET qty = ?, updated_at = NOW()
            WHERE user_id = ?
              AND product_id = ?
              AND (
                    product_variant_id = ?
                    OR (product_variant_id IS NULL AND ? IS NULL)
                  )
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $qty,
            $this->userId,
            $productId,
            $variantId,
            $variantId
        ]);
    }

    public function remove($productId, $variantId = null)
    {
        if (!$this->userId) {
            return false;
        }

        $productId = (int)$productId;
        $variantId = $variantId ? (int)$variantId : null;

        $sql = "
            DELETE FROM carts
            WHERE user_id = ?
              AND product_id = ?
              AND (
                    product_variant_id = ?
                    OR (product_variant_id IS NULL AND ? IS NULL)
                  )
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $this->userId,
            $productId,
            $variantId,
            $variantId
        ]);
    }

    public function clear()
    {
        if (!$this->userId) {
            return false;
        }

        $stmt = $this->pdo->prepare("DELETE FROM carts WHERE user_id = ?");
        return $stmt->execute([$this->userId]);
    }

    public function count()
    {
        if (!$this->userId) {
            return 0;
        }

        $stmt = $this->pdo->prepare("
            SELECT COALESCE(SUM(qty), 0) AS total
            FROM carts
            WHERE user_id = ?
        ");

        $stmt->execute([$this->userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)($row['total'] ?? 0);
    }
}