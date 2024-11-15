<?php


$conn = dbConnect();

if (isset($_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'user';
    $confirm_password = $_POST['confirm_password'];

    $warning_msg = validateRegisterInput($email, $password, $confirm_password);
    if (empty($warning_msg)) {
        if (checkUserExists($conn, $email)) {
            $warning_msg[] = 'Email already exists!';
        } else {
            registerUser($conn, $email, $password, $role);
            $success_msg[] = 'User registered!';
        }
    }
}
?>

<section class="register">
    <form action="" method="post">
        <h3>Register</h3>
        <p>Email</p>
        <input type="email" name="email" id="email" class="box" required>
        <p>Password</p>
        <input type="password" name="password" class="box" id="password" required>
        <p>Confirm Password</p>
        <input type="password" name="confirm_password" class="box" id="confirm_password" required>
        <button type="submit" class="btn">Register</button>
        <p>Already have an account? <a href="?page=login" class="login_link">Log in</a></p>
    </form>

    <?php if (isset($warning_msg)) : ?>
        <div class="warning">
            <?php foreach ($warning_msg as $msg) : ?>
                <p><?php echo $msg; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


</body>
</html>
