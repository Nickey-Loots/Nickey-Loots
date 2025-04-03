<?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
    <?php $login = logIn(); ?>
<?php endif ?>

<section class="login">
    <form action="" method="post">
        <h3>Log in</h3>
        <p>Email</p>
        <?php if (isset($login['credentials'])) : ?>
            <p class="empty"><?= $login['credentials'] ?></p>
        <?php elseif (isset($login['email'])) : ?>
            <p class="empty"><?= $login['email'] ?></p>
        <?php endif ?>
        <input type="text" name="email" id="email" class="box" required>
        <p>Password</p>
        <input type="password" name="password" class="box" id="password" required>
        <button type="submit" class="btn">Log in</button>
        <p>Don't have an account? <a href="?page=register" class="register_link">Sign up now</a></p>
    </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>

</html>