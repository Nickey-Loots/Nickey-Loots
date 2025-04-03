<?php isLoggedIn('?page=login'); ?>

<section class="orders">
    <h1 class="heading">my orders</h1>
    <div class="box-container">
        <?php $orders = getOrders($conn, $user_id); ?>
        <?php if ($orders->rowCount() > 0) : ?>
            <?php while ($order = $orders->fetch(PDO::FETCH_ASSOC)) : ?>
                <?php $product = getProduct($conn, $order['product_id']); ?>
                <?php if ($product->rowCount() > 0) : ?>
                    <?php $product_info = $product->fetch(PDO::FETCH_ASSOC); ?>
                    <div class="box <?= $order['status'] == 'cancelled' ? 'cancelled' : '' ?>">
                        <p class="date"><i class="fa fa-calendar"></i><span><?= date('d-m-Y H:i', strtotime($order['date'])); ?></span></p>
                        <img src="/images/uploaded/<?= $product_info['image']; ?>" class="image" alt="">
                        <h3 class="name"><?= $product_info['name']; ?></h3>
                        <p class="price">€ <?= $order['price']; ?> x <?= $order['qty']; ?></p>
                        <p class="status" style="color:<?= getOrderStatusStyle($order['status']); ?>"><?= $order['status']; ?></p>
                    </div>
                <?php endif ?>
            <?php endwhile ?>
        <?php else : ?>
            <p class='empty'>No orders found</p>
        <?php endif ?>
    </div>
</section>