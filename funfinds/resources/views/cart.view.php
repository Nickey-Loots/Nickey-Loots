<?php getCart(); ?>
<?php if (isset($_POST['update_cart'])) : updateCart();
endif ?>
<?php if (isset($_POST['delete_item'])) : deleteItem();
endif ?>
<?php if (isset($_POST['empty_cart'])) : emptyCart();
endif ?>
<?php isLoggedIn('?page=login'); ?>
<?php handlePostRequests(); ?>
<?php $conn = dbConnect(); ?>
<?php $user_id = $_SESSION['user_id']; ?>
<?php $cartProducts = getCartProducts($conn, $user_id); ?>


<section class="products">
    <h1 class="heading">shopping cart</h1>
    <div class="box-container">
        <?php $grand_total = 0; ?>
        <?php if ($cartProducts !== null) : ?>

            <?php foreach ($cartProducts as $cartProduct) : ?>
                <?php $fetch_cart = $cartProduct['cart']; ?>
                <?php $fetch_product = $cartProduct['product']; ?>
                <form action="" method="post" class="box">
                    <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                    <img src="/images/uploaded/<?= $fetch_product['image']; ?>" class="image" alt="">
                    <h3 class="name"><?= $fetch_product['name']; ?></h3>
                    <div class="flex">
                        <p class="price">€<?= $fetch_product['price']; ?></p>
                        <input type="number" name="qty" maxlength="2" min="1" value="<?= $fetch_cart['qty']; ?>" max="99" required class="qty">
                        <button type="submit" class="fas fa-edit" name="update_cart"></button>
                    </div>
                    <p class="sub-total">sub total: <span>€<?= $sub_total = (float)$fetch_product['price'] * (int)$fetch_cart['qty']; ?></span></p>
                    <input type="submit" value="delete item" class="deleteBtn" name="delete_item" onclick="return confirm('delete this item?');">
                </form>
                <?php $grand_total += $sub_total; ?>
            <?php endforeach ?>
        <?php else : ?>
            <p class="empty">your cart is empty!</p>
        <?php endif ?>
    </div>

    <?php if ($grand_total != 0) : ?>
        <div class="grand-total">
            <p>grand total : <span>€<?= $grand_total ?></span></p>
            <a href="?page=checkout" class="btn">proceed to checkout</a>
            <form action="" method="POST">
                <input type="submit" value="empty cart" name="empty_cart" class="deleteBtn" onclick="return confirm('empty your cart?')">
            </form>
        </div>
    <?php endif ?>
</section>