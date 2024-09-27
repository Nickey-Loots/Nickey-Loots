<?php

$conn = dbConnect();

function processOrder()
{
    $conn = dbConnect();
    if (isLoggedIn()) {
        $user_id =  $_SESSION['user_id'];
        if (isset($_POST['place_order'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $street = isset($_POST['street']) ? $_POST['street'] : '';
            $address = $_POST['flat'] . $street . ', ' . $_POST['city'] . '. ';

            if (empty($name) || empty($email) || empty($number) || empty($_POST['flat']) || empty($_POST['city'])) {
                $warning_msg[] = 'Name, email, number, address, and city are required!';
            } else if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $warning_msg[] = 'Only letters and white space allowed in name!';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $warning_msg[] = 'Invalid email format!';
            } else if (!preg_match("/^[0-9]*$/", $number)) {
                $warning_msg[] = 'Only numbers allowed in number!';
            } else {
                $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $verify_cart->execute([$user_id]);

                while ($cart_item = $verify_cart->fetch(PDO::FETCH_ASSOC)) {
                    $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
                    $get_product->execute([$cart_item['product_id']]);
                    if ($get_product->rowCount() > 0) {
                        while ($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)) {
                            $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, email, number, address, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?)");
                            $insert_order->execute([$user_id, $name, $email, $number, $address, $fetch_p['id'], $fetch_p['price'], $cart_item['qty']]);
                            $empty_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
                            $empty_cart->execute([$user_id]);
                        }
                        header('location: ?page=orders');
                    } else {
                        $warning_msg[] = 'Something went wrong!';
                    }
                }
            }
        }
    } else {
        echo 'er is iets fout';
    }
}


function get_product($conn, $id)
{
    $select_get = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $select_get->execute([$id]);
    return $select_get->fetch(PDO::FETCH_ASSOC);
}

function calculate_grand_total($product)
{
    return $product['price'];
}

function display_product_summary($product)
{
?>
    <div class="flex">
        <img src="./images/uploaded/<?= $product['image']; ?>" class="image" alt="">
        <div>
            <h3 class="name"><?= $product['name']; ?></h3>
            <p class="price">€ <?= $product['price']; ?> x 1</p>
        </div>
    </div>
<?php
}

$grand_total = 0;
if (isset($_GET['get_id'])) {
    $product = get_product($conn, $_GET['get_id']);
    $grand_total += calculate_grand_total($product);
    display_product_summary($product);
}
?>