<?php

class Cart
{
    private $db;
    private $userId;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
        $this->userId = $_SESSION['user']['id'] ?? null;
    }

    public function add($productId, $qty = 1, $variantId = null)
    {
        if (!$this->userId || !$this->db) {
            return false;
        }

        $productId = (int) $productId;
        $qty = (int) $qty;
        $variantId = $variantId ? (int) $variantId : null;

        if ($qty < 1) {
            $qty = 1;
        }

        try {
            if ($variantId) {
                $query = "
                    SELECT id, qty 
                    FROM carts 
                    WHERE user_id = ? 
                      AND product_id = ? 
                      AND product_variant_id = ?
                ";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$this->userId, $productId, $variantId]);
            } else {
                $query = "
                    SELECT id, qty 
                    FROM carts 
                    WHERE user_id = ? 
                      AND product_id = ? 
                      AND product_variant_id IS NULL
                ";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$this->userId, $productId]);
            }

            $existing = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existing) {
                $newQty = (int) $existing['qty'] + $qty;

                $updateQuery = "
                    UPDATE carts 
                    SET qty = ?, updated_at = NOW() 
                    WHERE id = ?
                ";
                $updateStmt = $this->db->prepare($updateQuery);
                $updateStmt->execute([$newQty, $existing['id']]);
            } else {
                $insertQuery = "
                    INSERT INTO carts 
                        (user_id, product_id, product_variant_id, qty, created_at, updated_at) 
                    VALUES 
                        (?, ?, ?, ?, NOW(), NOW())
                ";
                $insertStmt = $this->db->prepare($insertQuery);
                $insertStmt->execute([
                    $this->userId,
                    $productId,
                    $variantId,
                    $qty
                ]);
            }

            return true;
        } catch (Exception $e) {
            error_log("Cart add error: " . $e->getMessage());
            return false;
        }
    }

    public function remove($productId, $variantId = null)
    {
        if (!$this->userId || !$this->db) {
            return false;
        }

        $productId = (int) $productId;
        $variantId = $variantId ? (int) $variantId : null;

        try {
            if ($variantId) {
                $query = "
                    DELETE FROM carts 
                    WHERE user_id = ? 
                      AND product_id = ? 
                      AND product_variant_id = ?
                ";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$this->userId, $productId, $variantId]);
            } else {
                $query = "
                    DELETE FROM carts 
                    WHERE user_id = ? 
                      AND product_id = ?
                ";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$this->userId, $productId]);
            }

            return true;
        } catch (Exception $e) {
            error_log("Cart remove error: " . $e->getMessage());
            return false;
        }
    }

    public function update($productId, $qty, $variantId = null)
    {
        if (!$this->userId || !$this->db) {
            return false;
        }

        $productId = (int) $productId;
        $qty = (int) $qty;
        $variantId = $variantId ? (int) $variantId : null;

        if ($qty < 1) {
            return $this->remove($productId, $variantId);
        }

        try {
            if ($variantId) {
                $query = "
                    UPDATE carts 
                    SET qty = ?, updated_at = NOW() 
                    WHERE user_id = ? 
                      AND product_id = ? 
                      AND product_variant_id = ?
                ";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$qty, $this->userId, $productId, $variantId]);
            } else {
                $query = "
                    UPDATE carts 
                    SET qty = ?, updated_at = NOW() 
                    WHERE user_id = ? 
                      AND product_id = ? 
                      AND product_variant_id IS NULL
                ";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$qty, $this->userId, $productId]);
            }

            return true;
        } catch (Exception $e) {
            error_log("Cart update error: " . $e->getMessage());
            return false;
        }
    }

    public function getItems()
    {
        if (!$this->userId || !$this->db) {
            return [];
        }

        try {
            $query = "
                SELECT 
                    product_id, 
                    product_variant_id, 
                    qty 
                FROM carts 
                WHERE user_id = ? 
                ORDER BY created_at DESC
            ";

            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->userId]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $items = [];

            foreach ($rows as $row) {
                $productId = (int) $row['product_id'];
                $variantId = !empty($row['product_variant_id'])
                    ? (int) $row['product_variant_id']
                    : null;

                $key = $productId . '_' . ($variantId ?? 0);

                $items[$key] = [
                    'product_id' => $productId,
                    'product_variant_id' => $variantId,
                    'qty' => (int) $row['qty']
                ];
            }

            return $items;
        } catch (Exception $e) {
            error_log("Cart getItems error: " . $e->getMessage());
            return [];
        }
    }

    public function clear()
    {
        if (!$this->userId || !$this->db) {
            return false;
        }

        try {
            $query = "DELETE FROM carts WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->userId]);

            return true;
        } catch (Exception $e) {
            error_log("Cart clear error: " . $e->getMessage());
            return false;
        }
    }

    public function count()
    {
        if (!$this->userId || !$this->db) {
            return 0;
        }

        try {
            $query = "SELECT SUM(qty) AS total FROM carts WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->userId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int) ($row['total'] ?? 0);
        } catch (Exception $e) {
            error_log("Cart count error: " . $e->getMessage());
            return 0;
        }
    }

    public function subtotal($productModel = null)
    {
        if (!$this->userId || !$this->db) {
            return 0;
        }

        try {
            $items = $this->getItems();
            $total = 0;

            foreach ($items as $item) {
                $productId = (int) $item['product_id'];
                $variantId = $item['product_variant_id'];
                $qty = (int) $item['qty'];

                if ($variantId) {
                    $stmt = $this->db->prepare("
                        SELECT price, sale_price 
                        FROM product_variants 
                        WHERE id = ?
                    ");
                    $stmt->execute([$variantId]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                } else {
                    if ($productModel === null) {
                        continue;
                    }

                    $row = $productModel->find($productId);
                }

                if (!$row) {
                    continue;
                }

                $price = !empty($row['sale_price']) && $row['sale_price'] > 0
                    ? (float) $row['sale_price']
                    : (float) $row['price'];

                $total += $price * $qty;
            }

            return $total;
        } catch (Exception $e) {
            error_log("Cart subtotal error: " . $e->getMessage());
            return 0;
        }
    }
}