<?php

function getProducts()
{
    $conn = dbConnect();

    $select_products = $conn->prepare("SELECT * FROM `products`");
    $select_products->execute();

    $products = [];
    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
        $products[] = $fetch_product;
    }

    return $products;
}



function selectProduct()
{
    $conn = dbConnect();
    $select_products = $conn->prepare("SELECT * FROM `products`");
    $select_products->execute();

    return $select_products;
}
