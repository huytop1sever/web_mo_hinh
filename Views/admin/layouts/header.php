<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?></title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="/assets/admin/css/admin.css">
    <link rel="stylesheet" href="/assets/admin/css/users.css">
    <link rel="stylesheet" href="/assets/admin/css/orders.css">
    <link rel="stylesheet" href="/assets/admin/css/posts.css">
    <link rel="stylesheet" href="/assets/admin/css/category.css">
    <link rel="stylesheet" href="/assets/admin/css/product-form.css">


    <?php if (!empty($css)): ?>
        <link rel="stylesheet" href="../assets/admin/css/<?= $css ?>.css">
    <?php endif; ?>

</head>
<body>

<div class="admin-layout">