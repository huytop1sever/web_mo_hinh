<?php

class Product
{
    private $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
    }

    public function getAll($keyword = '', $categoryId = '', $limit = 10, $offset = 0)
    {
        $sql = "
            SELECT 
                p.id,
                p.title AS name,
                p.image,
                p.description,
                p.content,
                p.category_id,
                p.created_at,
                c.name AS category,
                MIN(pv.price) AS price,
                MIN(
                    CASE 
                        WHEN pv.sale_price IS NOT NULL AND pv.sale_price > 0 
                        THEN pv.sale_price 
                        ELSE NULL 
                    END
                ) AS sale_price,
                COALESCE(SUM(pv.stock), 0) AS total_stock,
                COUNT(pv.id) AS variant_count,
                MAX(pv.status) AS product_status
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN product_variants pv ON pv.product_id = p.id
            WHERE 1
        ";

        if ($keyword !== '') {
            $sql .= " AND p.title LIKE :keyword ";
        }

        if ($categoryId !== '') {
            $sql .= " AND p.category_id = :category_id ";
        }

        $sql .= "
            GROUP BY 
                p.id,
                p.title,
                p.image,
                p.description,
                p.content,
                p.category_id,
                p.created_at,
                c.name
            ORDER BY p.id DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->pdo->prepare($sql);

        if ($keyword !== '') {
            $stmt->bindValue(':keyword', '%' . $keyword . '%');
        }

        if ($categoryId !== '') {
            $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        }

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function countAll($keyword = '', $categoryId = '')
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM products p
            WHERE 1
        ";

        if ($keyword !== '') {
            $sql .= " AND p.title LIKE :keyword ";
        }

        if ($categoryId !== '') {
            $sql .= " AND p.category_id = :category_id ";
        }

        $stmt = $this->pdo->prepare($sql);

        if ($keyword !== '') {
            $stmt->bindValue(':keyword', '%' . $keyword . '%');
        }

        if ($categoryId !== '') {
            $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        }

        $stmt->execute();

        return (int)$stmt->fetchColumn();
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function find($id)
    {
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
            WHERE p.id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getVariants($productId)
    {
        $sql = "
            SELECT *
            FROM product_variants
            WHERE product_id = :product_id
            ORDER BY id ASC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function create($data)
    {
        $sql = "
            INSERT INTO products 
            (title, description, content, image, category_id, created_at, updated_at)
            VALUES 
            (:title, :description, :content, :image, :category_id, NOW(), NOW())
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':content', $data['content']);
        $stmt->bindValue(':image', $data['image']);
        $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function update($data)
    {
        $sql = "
            UPDATE products SET
                title = :title,
                description = :description,
                content = :content,
                image = :image,
                category_id = :category_id,
                updated_at = NOW()
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':content', $data['content']);
        $stmt->bindValue(':image', $data['image']);
        $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function saveVariants($productId, $variants)
    {
        if (empty($variants)) {
            return;
        }

        foreach ($variants as $variant) {
            if (empty($variant['variant_name']) || empty($variant['price'])) {
                continue;
            }

            $salePrice = null;

            if (isset($variant['sale_price']) && trim($variant['sale_price']) !== '') {
                $salePrice = $variant['sale_price'];
            }

            $sql = "
                INSERT INTO product_variants
                (product_id, variant_name, sku, price, sale_price, stock, status, created_at, updated_at)
                VALUES
                (:product_id, :variant_name, :sku, :price, :sale_price, :stock, :status, NOW(), NOW())
            ";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
            $stmt->bindValue(':variant_name', $variant['variant_name']);
            $stmt->bindValue(':sku', $variant['sku'] ?? '');
            $stmt->bindValue(':price', $variant['price']);
            $stmt->bindValue(':sale_price', $salePrice);
            $stmt->bindValue(':stock', $variant['stock'] ?? 0, PDO::PARAM_INT);
            $stmt->bindValue(':status', $variant['status'] ?? 1, PDO::PARAM_INT);

            $stmt->execute();
        }
    }

    public function updateVariants($productId, $variants)
    {
        $sqlDelete = "DELETE FROM product_variants WHERE product_id = :product_id";

        $stmtDelete = $this->pdo->prepare($sqlDelete);
        $stmtDelete->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $stmtDelete->execute();

        $this->saveVariants($productId, $variants);
    }

    public function delete($id)
    {
        $sqlVariant = "DELETE FROM product_variants WHERE product_id = :product_id";
        $stmtVariant = $this->pdo->prepare($sqlVariant);
        $stmtVariant->bindValue(':product_id', $id, PDO::PARAM_INT);
        $stmtVariant->execute();

        $sql = "DELETE FROM products WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}