<?php

require_once __DIR__ . '/../config/database.php';

class Product
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll()
    {
        $sql = "
            SELECT
                p.id,
                p.title AS name,
                p.image,
                c.name AS category,
                p.description,
                COALESCE(MIN(v.sale_price), MIN(v.price), 0) AS price,
                COALESCE(SUM(v.stock), 0) AS stock,
                CASE
                    WHEN COALESCE(SUM(v.stock), 0) = 0 THEN 'Hết hàng'
                    WHEN COALESCE(SUM(v.stock), 0) <= 5 THEN 'Sắp hết'
                    ELSE 'Đang bán'
                END AS status
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN product_variants v ON p.id = v.product_id
            GROUP BY p.id
            ORDER BY p.id DESC
        ";

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories()
    {
        $result = $this->conn->query("SELECT * FROM categories ORDER BY id DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getVariants($productId)
    {
        $productId = (int)$productId;

        $sql = "SELECT * FROM product_variants WHERE product_id = $productId ORDER BY id ASC";
        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id)
    {
        $id = (int)$id;

        $sql = "
            SELECT
                p.*,
                p.title AS name,
                c.name AS category
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.id = $id
        ";

        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function create($data)
    {
        $title = $this->conn->real_escape_string($data['title']);
        $description = $this->conn->real_escape_string($data['description']);
        $content = $this->conn->real_escape_string($data['content']);
        $image = $this->conn->real_escape_string($data['image']);
        $category_id = (int)$data['category_id'];
        $status = (int)$data['status'];

        $sql = "
            INSERT INTO products
            (title, description, content, image, category_id, status, created_at, updated_at)
            VALUES
            ('$title', '$description', '$content', '$image', $category_id, $status, NOW(), NOW())
        ";

        $this->conn->query($sql);
        $productId = $this->conn->insert_id;

        $this->saveVariants($productId, $data);

        return true;
    }

    public function update($data)
    {
        $id = (int)$data['id'];
        $title = $this->conn->real_escape_string($data['title']);
        $description = $this->conn->real_escape_string($data['description']);
        $content = $this->conn->real_escape_string($data['content']);
        $image = $this->conn->real_escape_string($data['image']);
        $category_id = (int)$data['category_id'];
        $status = (int)$data['status'];

        $sql = "
            UPDATE products SET
                title = '$title',
                description = '$description',
                content = '$content',
                image = '$image',
                category_id = $category_id,
                status = $status,
                updated_at = NOW()
            WHERE id = $id
        ";

        $this->conn->query($sql);

        $this->conn->query("DELETE FROM product_variants WHERE product_id = $id");
        $this->saveVariants($id, $data);

        return true;
    }

    private function saveVariants($productId, $data)
    {
        if (empty($data['variant_name'])) {
            return;
        }

        foreach ($data['variant_name'] as $key => $variantName) {
            if (trim($variantName) === '') {
                continue;
            }

            $variant_name = $this->conn->real_escape_string($variantName);
            $sku = $this->conn->real_escape_string($data['sku'][$key] ?? '');
            $price = (float)($data['price'][$key] ?? 0);
            $sale_price = $data['sale_price'][$key] !== '' ? (float)$data['sale_price'][$key] : 'NULL';
            $stock = (int)($data['stock'][$key] ?? 0);
            $image = $this->conn->real_escape_string($data['variant_image'][$key] ?? '');
            $status = (int)($data['variant_status'][$key] ?? 1);

            $sql = "
                INSERT INTO product_variants
                (product_id, variant_name, sku, price, sale_price, stock, image, status, created_at, updated_at)
                VALUES
                ($productId, '$variant_name', '$sku', $price, $sale_price, $stock, '$image', $status, NOW(), NOW())
            ";

            $this->conn->query($sql);
        }
    }

    public function delete($id)
    {
        $id = (int)$id;

        $this->conn->query("DELETE FROM product_variants WHERE product_id = $id");
        return $this->conn->query("DELETE FROM products WHERE id = $id");
    }
}