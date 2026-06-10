<?php
$totalRevenue = $totalRevenue ?? 0;
$orderCount = $orderCount ?? 0;
$userCount = $userCount ?? 0;
$productCount = $productCount ?? 0;
$latestOrders = $latestOrders ?? [];
$topProducts = $topProducts ?? [];

$statusText = [
    'pending' => 'Ch&#7901; x&#225;c nh&#7853;n',
    'confirmed' => '&#272;&#227; x&#225;c nh&#7853;n',
    'shipping' => '&#272;ang giao',
    'delivered' => 'Ho&#224;n th&#224;nh',
    'cancelled' => '&#272;&#227; h&#7911;y'
];
?>

<div class="dashboard-grid">

    <div class="dashboard-card">
        <div class="card-top">
            <h3>T&#7893;ng doanh thu</h3>
            <i class='bx bx-dollar-circle'></i>
        </div>

        <p><?= number_format((float) $totalRevenue, 0, ',', '.') ?>&#273;</p>
    </div>

    <div class="dashboard-card">
        <div class="card-top">
            <h3>&#272;&#417;n h&#224;ng</h3>
            <i class='bx bx-cart'></i>
        </div>

        <p><?= number_format((int) $orderCount, 0, ',', '.') ?></p>
    </div>

    <div class="dashboard-card">
        <div class="card-top">
            <h3>Ng&#432;&#7901;i d&#249;ng</h3>
            <i class='bx bx-user'></i>
        </div>

        <p><?= number_format((int) $userCount, 0, ',', '.') ?></p>
    </div>

    <div class="dashboard-card">
        <div class="card-top">
            <h3>S&#7843;n ph&#7849;m</h3>
            <i class='bx bx-package'></i>
        </div>

        <p><?= number_format((int) $productCount, 0, ',', '.') ?></p>
    </div>

</div>

<div class="content-grid">

    <div class="box">
        <div class="box-title">
            <h2>&#272;&#417;n h&#224;ng m&#7899;i</h2>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>M&#227; &#273;&#417;n</th>
                        <th>Kh&#225;ch h&#224;ng</th>
                        <th>T&#7893;ng ti&#7873;n</th>
                        <th>Tr&#7841;ng th&#225;i</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($latestOrders as $order): ?>
                        <?php $status = $order['status'] ?? 'pending'; ?>
                        <tr>
                            <td>#OD<?= (int) $order['id'] ?></td>
                            <td><?= htmlspecialchars($order['name'] ?? $order['customer_name'] ?? '') ?></td>
                            <td><?= number_format((float) ($order['total_price'] ?? $order['total'] ?? 0), 0, ',', '.') ?>&#273;</td>
                            <td>
                                <span class="status <?= htmlspecialchars($status) ?>">
                                    <?= $statusText[$status] ?? 'Kh&#244;ng x&#225;c &#273;&#7883;nh' ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($latestOrders)): ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">
                                Ch&#432;a c&#243; &#273;&#417;n h&#224;ng
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box">
        <div class="box-title">
            <h2>S&#7843;n ph&#7849;m n&#7893;i b&#7853;t</h2>
        </div>

        <div class="top-product-list">
            <?php foreach ($topProducts as $product): ?>
                <div class="top-product-item">
                    <?php if (!empty($product['image'])): ?>
                        <img src="../<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/65" alt="">
                    <?php endif; ?>

                    <div class="top-product-info">
                        <h4><?= htmlspecialchars($product['title']) ?></h4>
                        <span><?= number_format((int) ($product['sold'] ?? 0), 0, ',', '.') ?> &#273;&#417;n b&#225;n</span>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (empty($topProducts)): ?>
                <p>Ch&#432;a c&#243; s&#7843;n ph&#7849;m</p>
            <?php endif; ?>
        </div>
    </div>

</div>
