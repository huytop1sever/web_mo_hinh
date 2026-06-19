<?php

class Cart
{
    private $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
    }

    public function getByUser($userId)
    {
        $sql = "
            SELECT 
                c.id AS cart_id,
                c.qty,

                p.id AS product_id,
                p.title,
                p.image AS product_image,

                pv.id AS variant_id,
                pv.variant_name,
                pv.price,
                pv.sale_price,
                pv.stock,
                pv.image AS variant_image

            FROM carts c
            INNER JOIN products p 
                ON c.product_id = p.id
            INNER JOIN product_variants pv 
                ON c.product_variant_id = pv.id
            WHERE c.user_id = :user_id
            ORDER BY c.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId
        ]);

        return $stmt->fetchAll();
    }

    public function add($userId, $productId, $variantId, $qty = 1)
    {
        $sql = "
            SELECT id FROM carts
            WHERE user_id = :user_id
            AND product_id = :product_id
            AND product_variant_id = :variant_id
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId,
            ':product_id' => $productId,
            ':variant_id' => $variantId
        ]);

        $cart = $stmt->fetch();

        if ($cart) {
            $sql = "
                UPDATE carts
                SET qty = qty + :qty,
                    updated_at = NOW()
                WHERE id = :id
            ";

            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':qty' => $qty,
                ':id' => $cart['id']
            ]);
        }

        $sql = "
            INSERT INTO carts (
                user_id,
                product_id,
                product_variant_id,
                qty,
                created_at,
                updated_at
            ) VALUES (
                :user_id,
                :product_id,
                :variant_id,
                :qty,
                NOW(),
                NOW()
            )
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':product_id' => $productId,
            ':variant_id' => $variantId,
            ':qty' => $qty
        ]);
    }

    public function delete($cartId, $userId)
    {
        $sql = "DELETE FROM carts WHERE id = :id AND user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $cartId,
            ':user_id' => $userId
        ]);
    }
}