<?php

$conn = dbConnect();
if (isset($_SESSION['user_id']) === true && empty($_SESSION['user_id']) === false) {
    $user_id = $_SESSION['user_id'];
}




function getCartAmount()
{
    if (isLoggedIn() === false) {
        return null;
    }

    $conn = dbConnect();
    $user_id = $_SESSION['user_id'];

    $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $count_cart_items->execute([$user_id]);

    return $count_cart_items->rowCount();
}


function addToCart()
{
    $conn = dbConnect();
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];

    $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
    $verify_cart->execute([$user_id, $product_id]);

    $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $max_cart_items->execute([$user_id]);

    if ($verify_cart->rowCount() > 0) {
        $warning_msg['Already added to cart!'] = 'Already added to cart!';
    } elseif ($max_cart_items->rowCount() == 10) {
        $warning_msg[] = 'Cart is full!';
    } else {
        $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, product_id, price, qty) VALUES(?,?,?,?)");
        $insert_cart->execute([$user_id, $product_id, $fetch_price['price'], $qty]);
        header('location: ?page=home');
    }
}

function updateCart()
{
    $conn = dbConnect();
    $user_id = $_SESSION['user_id'];
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_NUMBER_INT);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_NUMBER_INT);

    $update_cart = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ? AND user_id = ?");
    $update_cart->execute([$qty, $cart_id, $user_id]);
}

function deleteItem()
{
    $conn = dbConnect();
    $user_id = $_SESSION['user_id'];
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_NUMBER_INT);

    $verify_delete_item = $conn->prepare("SELECT * FROM `cart` WHERE id = ? AND user_id = ?");
    $verify_delete_item->execute([$cart_id, $user_id]);

    if ($verify_delete_item->rowCount() > 0) {
        $delete_item = $conn->prepare("DELETE FROM `cart` WHERE id = ? AND user_id = ?");
        $delete_item->execute([$cart_id, $user_id]);
    }

    header('location: ?page=cart');
}

function getCart()
{
    $conn = dbConnect();
    $user_id = $_SESSION['user_id'];
    $get_cart = $conn->prepare("SELECT * FROM `cart` WHERE `user_id` = ?");
    $get_cart->execute([$user_id]);
}

function emptyCart()
{
    $conn = dbConnect();
    $user_id = $_SESSION['user_id'];
    $verify_empty_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $verify_empty_cart->execute([$user_id]);

    if ($verify_empty_cart->rowCount() > 0) {
        $empty_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id =? ");
        $empty_cart->execute([$user_id]);
        $success_msg[] = 'Removed all from cart!';
        header('location: ?page=cart');
    } else {
        $warning_msg[] = 'Already removed all!';
    }
}

function handlePostRequests()
{
    if (isset($_POST['update_cart'])) {
        updateCart();
    }
    if (isset($_POST['delete_item'])) {
        deleteItem();
    }
    if (isset($_POST['empty_cart'])) {
        emptyCart();
    }
}

function getCartProducts($conn, $user_id)
{
    $products = [];
    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $select_cart->execute([$user_id]);
    if ($select_cart->rowCount() > 0) {
        while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$fetch_cart['product_id']]);
            if ($select_products->rowCount() > 0) {
                $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                $products[] = ['cart' => $fetch_cart, 'product' => $fetch_product];
            }
        }
        return $products;
    }
}
