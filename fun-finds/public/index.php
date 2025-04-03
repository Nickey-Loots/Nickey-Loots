<?php

session_start();

require_once '../config.php';
require_once '../libs/helper.php';
require_once '../controllers/products.php';
require_once '../controllers/cart.php';
require_once '../controllers/orders.php';
require_once '../controllers/checkout.php';
require_once '../controllers/account.php';
require_once '../controllers/manageProducts.php';
require_once '../controllers/manageOrders.php';

?>

<!DOCTYPE html>
<html lang="<?= $_ENV['LANG'] ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FunFinds</title>

    <link rel="shortcut icon" href="../images/funfinds.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="../css/app.css">

    <script src="../js/app.js" defer></script>
</head>

<body>
    <?php require_once '../resources/views/components/header.view.php'; ?>

    <?php require_once getPage(); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>

</html>