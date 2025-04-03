<?php
function products()
{
    $conn = dbConnect();

    $select_products = $conn->prepare("SELECT * FROM `products`");
    $select_products->execute();
    $products = $select_products->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}



function updateProduct($product_details)
{
    $conn = dbConnect();
    $image = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageFolder = 'images/uploaded/' . $image;

    $edit_product = $conn->prepare("UPDATE `products` SET name=?, price=?, image=? WHERE id=?");
    $edit_product->execute($product_details);
    return 'Product updated!';
}

function getEditProduct($id)
{
    $conn = dbConnect();
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editProduct($name, $price, $image)
{
    $name = filter_var($name);
    $price = filter_var($price);
    $image_name = $image['name'];
    $imageTmp = $image['tmp_name'];
    $imageSize = $image['size'];
    $image_folder = '/images/uploaded/' . $image_name;

    if (!empty($image['name'])) {
        if ($imageSize > 2000000) {
            return 'Image size is too large!';
        }

        move_uploaded_file($imageTmp, $image_folder);
    }

    header('location: ?page=products');
}


function delete()
{
    $conn = dbConnect();
    if (isset($_POST['delete'])) {
        $id = $_POST['delete_id'];

        $get_product = $conn->prepare("SELECT image FROM `products` WHERE id=?");
        $get_product->execute([$id]);
        $product = $get_product->fetch();

        if ($product) {

            $image_path = 'images/uploaded/' . $product['image'];

            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $delete_product = $conn->prepare("DELETE FROM `products` WHERE id=?");
            $delete_product->execute([$id]);
        }
        header('location: ?page=products');
    }
}

function addProduct($conn)
{
    if (isset($_POST['addProduct'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageFolder = 'images/uploaded/' . $image;

        if (empty($name) || empty($price) || empty($image)) {
            $warning_msg[] = 'Name, price, and image are required!';
        } else if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $warning_msg[] = 'Only letters and white space allowed in name!';
        } else if (!is_numeric($price)) {
            $warning_msg[] = 'Price must be a number!';
        } else if ($imageSize > 2000000) {
            $warning_msg[] = 'Image size is too large!';
        } else {
            $product_details = [$name, $price, $image];
            $addProduct = $conn->prepare("INSERT INTO `products`(name, price, image) VALUES(?,?,?)");
            $addProduct->execute([$name, $price, $image]);
            move_uploaded_file($imageTmp, $imageFolder);
            $success_msg[] = 'Product uploaded!';
        }

        header('location: ?page=products');
    }
}
