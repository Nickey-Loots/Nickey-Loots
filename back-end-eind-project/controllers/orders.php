<?php

function getOrders($conn, $user_id) {
    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
    $select_orders->execute([$user_id]);
    return $select_orders;
}

function getProduct($conn, $product_id) {
    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $select_product->execute([$product_id]);
    return $select_product;
}

function getOrderStatusStyle($status) {
    if ($status == 'delivered') {
        return 'green';
    } elseif ($status == 'canceled') {
        return 'red';
    } else {
        return 'orange';
    }
}