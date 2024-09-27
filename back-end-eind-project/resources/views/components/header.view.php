<?php if (isset($_POST['logout'])) : ?>
    <?php logOut(); ?>
<?php endif ?>

<header class="header">

    <section class="flex">

        <a href="?page=home"><img class="logo" src="../images/text.png" alt="funfinds"></a>

        <nav class="navbar">
            <?php if (isAdmin()) : ?>
                <!-- Admin header -->
                <a href="?page=products">Manage Products</a>
                <a href="?page=seeOrders">Manage Orders</a>
                <form action="" method="POST" class="logout-form">
                    <button type="submit" name="logout"><i class="fas fa-sign-out-alt"></i></button>
                </form>
                <?php if (isset($_SESSION['email'])) : ?>
                    <p>Welcome, <?= $_SESSION['email'] ?></p>
                <?php endif ?>
            <?php elseif (isset($_SESSION['user_id'])) : ?>
                <!-- Regular header -->
                <a href="?page=home">View products</a>
                <a href="?page=orders">my orders</a>
                <a href="?page=cart">cart <span><?= getCartAmount() ?></span></a>
                <form action="" method="POST" class="logout-form">
                    <button type="submit" name="logout"><i class="fas fa-sign-out-alt"></i></button>
                </form>
                <?php if (isset($_SESSION['email'])) : ?>
                    <p>Welcome, <?= $_SESSION['email'] ?></p>
                <?php endif ?>
            <?php else : ?>
                <a href="?page=home">View products</a>
                <a href="?page=orders">my orders</a>
                <a href="?page=cart">cart</a>
                <a href="?page=login">Login</a>
            <?php endif ?>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>

</header>