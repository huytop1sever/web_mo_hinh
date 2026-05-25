<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?></title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   <link rel="stylesheet" href="/assets/css/admin.css">
<link rel="stylesheet" href="/assets/css/admin/users.css">
<link rel="stylesheet" href="/assets/css/admin/orders.css">


    <?php if (!empty($css)): ?>
        <link rel="stylesheet" href="../assets/css/admin/<?= $css ?>.css">
    <?php endif; ?>

</head>
<body>

<div class="admin-layout">