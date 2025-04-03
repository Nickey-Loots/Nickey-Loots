<?php

isLoggedIn('?page=login');

processOrder();

$user_id =  $_SESSION['user_id'];

?>

<section class="checkout">
    <h1 class="heading">checkout summary</h1>
    <div class="row">
        <form action="" method="POST">
            <h3>billing details</h3>
            <div class="flex">
                <div class="box">
                    <p>your email <span>*</span></p>
                    <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="input">
                    <p>your name <span>*</span></p>
                    <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="input">
                    <p>your number <span>*</span></p>
                    <input type="number" name="number" required maxlength="10" minlength="10" placeholder="enter your number" class="input" min="0" max="9999999999">
                </div>
                <div class="box">
                    <p>address <span>*</span></p>
                    <input type="text" name="flat" required maxlength="50" placeholder="e.g. flat & building number" class="input">
                    <p>city name <span>*</span></p>
                    <input type="text" name="city" required maxlength="50" placeholder="enter your city name" class="input">
                </div>
            </div>
            <input type="submit" value="place order" name="place_order" class="btn">
            <a href="index.php" class="deleteBtn">Cancel Order</a>
        </form>
        <div class="summary">
            <p class="title">Total items :</h3>
                <?php $grand_total = 0; ?>
                <?php if (isset($_GET['get_id'])) : ?>
                    <?php $product = get_product($conn, $_GET['get_id']); ?>
                    <?php $grand_total += calculate_grand_total($product); ?>
                <?php else : ?>
                    <?php $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?"); ?>
                    <?php $select_cart->execute([$user_id]); ?>
                    <?php if ($select_cart->rowCount() > 0) : ?>
                        <?php while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) : ?>
                            <?php $product = get_product($conn, $fetch_cart['product_id']); ?>
                            <?php $sub_total = ($fetch_cart['qty'] * $product['price']); ?>
                            <?php $grand_total += $sub_total; ?>
            <div class="flex">
                <img src="/images/uploaded/<?= $product['image']; ?>" class="image" alt="">
                <div>
                    <h3 class="name"><?= $product['name']; ?></h3>
                    <p class="price">€ <?= $product['price']; ?> x 1</p>
                </div>
            </div>
        <?php endwhile ?>
    <?php endif ?>
<?php endif ?>
<div class="grand-total"><span>grand total :</span>
    <p>€ <?= $grand_total; ?></p>
</div>
        </div>
    </div>
</section>