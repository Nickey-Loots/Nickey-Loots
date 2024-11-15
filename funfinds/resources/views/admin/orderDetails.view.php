<?php


if (isset($_GET['id'])) {
    $get_id = $_GET['id'];
} else {
    $get_id = '';
    header('location:?page=seeOrders');
    exit();
}

if (isset($_POST['cancel'])) {
    cancelOrder($get_id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>

<body>

    <section class="view-order">
        <h1 class="heading">Order Details</h1>
        <?php $id = isset($_GET['id']) ? $_GET['id'] : null; ?>
        <?php $orders = getOrderDetails($id); ?>
        <?php $grandTotal = 0; ?>
        <?php if (count($orders) > 0) : ?>
            <?php foreach ($orders as $order) : ?>
                <?php $subTotal = ($order['price'] * $order['qty']); ?>
                <?php $grandTotal += $subTotal; ?>
                <?php $statusColor = $order['status'] == 'delivered' ? 'green' : ($order['status'] == 'canceled' ? 'red' : 'orange'); ?>
                <?php $products = getProductDetails($order['product_id']); ?>
                <?php if (count($products) <= 0) : ?>
                    <p class="empty">Product not found!</p>
                <?php endif ?>

                <?php foreach ($products as $product) : ?>
                    <div class="row">
                        <div class="col">
                            <p class="title"><i class="fas fa-calendar"></i> <?= $order['date']; ?></p>
                            <img src="/images/uploaded/<?= $product['image']; ?>" class="image" alt="">
                            <h3 class="name"><?= $product['name']; ?></h3>
                            <p class="price">€ <?= $order['price']; ?> x <?= $order['qty']; ?></p>
                            <p class="grand-total">grand total : <span>€<?= $grandTotal; ?></span></p>
                        </div>
                        <div class="col">
                            <p class="title">Billing Address</p>
                            <p class="user"><i class="fas fa-user"></i> <?= $order['name']; ?></p>
                            <p class="user"><i class="fas fa-envelope"></i> <?= $order['email'] ?></p>
                            <p class="user"><i class="fas fa-phone"></i> <?= $order['number']; ?></p>
                            <p class="user"><i class="fas fa-map-marker-alt"></i> <?= $order['address']; ?></p>
                            <p class="title">Status</p>
                            <p class="status" style="color:<?= $statusColor ?>"><?= $order['status']; ?></p>
                            <?php if ($order['status'] != 'cancelled') : ?>
                                <form action="" method="post">
                                    <input type="submit" value="Cancel Order" name="cancel" class="deleteBtn cancelForm" onclick="return confirm('Cancel this order?');">
                                </form>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endforeach ?>
        <?php else : ?>
            <p class="empty">Order was not found!</p>
        <?php endif ?>
    </section>

</body>

</html>