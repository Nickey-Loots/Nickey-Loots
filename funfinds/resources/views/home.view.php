<?php $products = getProducts(); ?>

<?php if (isset($_POST['add_to_cart'])) : addToCart();
endif ?>


<section class="products">
    <h1 class="heading">all products</h1>
    <div class="box-container">
        <?php foreach ($products as $product) : ?>
            <form action="" method="POST" class="box">
                <img src="/images/uploaded/<?= $product['image']; ?>" class="image" alt="">
                <h3 class="name"><?= $product['name'] ?></h3>
                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                <div class="flex">
                    <p class="price">€<?= $product['price'] ?></p>
                    <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                </div>
                <input type="submit" name="add_to_cart" value="add to cart" class="btn">
            </form>
        <?php endforeach ?>
    </div>
</section>