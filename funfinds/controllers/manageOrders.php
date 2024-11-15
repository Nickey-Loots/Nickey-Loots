<?php

function getOrderDetails($id)
{
    $conn = dbConnect();
    $selectOrders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
    $selectOrders->execute([$id]);
    return $selectOrders->fetchAll(PDO::FETCH_ASSOC);
}


function getProductDetails($product_id)
{
    $conn = dbConnect();
    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $select_product->execute([$product_id]);
    return $select_product->fetchAll(PDO::FETCH_ASSOC);
}

function cancelOrder($id)
{
    $conn = dbConnect();
    $updateOrder = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
    $updateOrder->execute(['cancelled', $id]);
}



function getAllOrders()
{
    $conn = dbConnect();
    $query = "SELECT * FROM orders";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
