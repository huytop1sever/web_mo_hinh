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

        $productId = (int)$productId;
        $qty = (int)$qty;
        if ($qty < 1) $qty = 1;

        $variantId = $variantId ? (int)$variantId : null;

        try {
            $query = "SELECT id, qty FROM carts WHERE user_id = ? AND product_id = ? AND product_variant_id IS ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->userId, $productId, $variantId]);
            $existing = $stmt->fetch();

            if ($existing) {
                $newQty = $existing['qty'] + $qty;
                $updateQuery = "UPDATE carts SET qty = ?, updated_at = NOW() WHERE id = ?";
                $updateStmt = $this->db->prepare($updateQuery);
                $updateStmt->execute([$newQty, $existing['id']]);
            } else {
                $insertQuery = "INSERT INTO carts (user_id, product_id, product_variant_id, qty, created_at, updated_at) 
                                VALUES (?, ?, ?, ?, NOW(), NOW())";
                $insertStmt = $this->db->prepare($insertQuery);
                $insertStmt->execute([$this->userId, $productId, $variantId, $qty]);
            }

            return true;
        } catch (Exception $e) {
            error_log("Cart add error: " . $e->getMessage());
            return false;
        }
    }

    public function remove($productId)
    {
        if (!$this->userId || !$this->db) {
            return false;
        }

        $productId = (int)$productId;

        try {
            $query = "DELETE FROM carts WHERE user_id = ? AND product_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->userId, $productId]);
            return true;
        } catch (Exception $e) {
            error_log("Cart remove error: " . $e->getMessage());
            return false;
        }
    }

    public function update($productId, $qty)
    {
        if (!$this->userId || !$this->db) {
            return false;
        }

        $productId = (int)$productId;
        $qty = (int)$qty;

        if ($qty < 1) {
            return $this->remove($productId);
        }

        try {
            $query = "UPDATE carts SET qty = ?, updated_at = NOW() WHERE user_id = ? AND product_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$qty, $this->userId, $productId]);
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
            $query = "SELECT product_id, product_variant_id, qty FROM carts WHERE user_id = ? ORDER BY created_at DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->userId]);
            $rows = $stmt->fetchAll();

            $items = [];
            foreach ($rows as $row) {
                $items[$row['product_id']] = $row['qty'];
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
            $query = "SELECT SUM(qty) as total FROM carts WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->userId]);
            $row = $stmt->fetch();
            return (int)($row['total'] ?? 0);
        } catch (Exception $e) {
            error_log("Cart count error: " . $e->getMessage());
            return 0;
        }
    }

    public function subtotal($productModel = null)
    {
        if (!$this->userId || $productModel === null || !$this->db) {
            return 0;
        }

        try {
            $items = $this->getItems();
            $total = 0;

            foreach ($items as $productId => $qty) {
                $product = $productModel->find($productId);
                if (!$product) continue;

                $price = (isset($product['sale_price']) && $product['sale_price'] > 0) ? $product['sale_price'] : $product['price'];
                $total += ((int)$price) * ((int)$qty);
            }

            return $total;
        } catch (Exception $e) {
            error_log("Cart subtotal error: " . $e->getMessage());
            return 0;
        }
    }
}
