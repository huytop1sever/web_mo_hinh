<?php

class DashboardController
{
    public function index()
    {
        $title = 'Dashboard';
        $pageTitle = 'Dashboard';

        global $conn;

        $totalRevenue = $this->fetchValue(
            $conn,
            "SELECT COALESCE(SUM(total_price), 0) FROM orders WHERE status <> 'cancelled'"
        );
        $orderCount = $this->fetchValue($conn, "SELECT COUNT(*) FROM orders");
        $userCount = $this->fetchValue($conn, "SELECT COUNT(*) FROM users");
        $productCount = $this->fetchValue($conn, "SELECT COUNT(*) FROM products");

        $latestOrders = $this->fetchAll(
            $conn,
            "SELECT id, name, total_price, status
             FROM orders
             ORDER BY id DESC
             LIMIT 5"
        );

        $topProducts = $this->fetchAll(
            $conn,
            "SELECT p.id, p.title, p.image, COALESCE(SUM(od.qty), 0) AS sold
             FROM products p
             LEFT JOIN order_detail od ON od.product_id = p.id
             GROUP BY p.id, p.title, p.image
             ORDER BY sold DESC, p.id DESC
             LIMIT 4"
        );

        include_once __DIR__ . '/../../Views/admin/layouts/header.php';
        include_once __DIR__ . '/../../Views/admin/layouts/sidebar.php';
        include_once __DIR__ . '/../../Views/admin/layouts/navbar.php';

        include_once __DIR__ . '/../../Views/admin/dashboard/index.php';

        include_once __DIR__ . '/../../Views/admin/layouts/footer.php';
    }

    private function fetchValue(PDO $pdo, string $sql)
    {
        return $pdo->query($sql)->fetchColumn();
    }

    private function fetchAll(PDO $pdo, string $sql): array
    {
        return $pdo->query($sql)->fetchAll();
    }
}
