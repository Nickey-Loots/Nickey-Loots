<?php


$id = $_GET['edit_id'];

if (isset($_GET['edit_id'])) {
    $product = getEditProduct($id);
    $name = $product['name'];
    $price = $product['price'];
    $image = $product['image'];
}

if (isset($_POST['edit_product'])) {
    $product_details = [
        $_POST['name'],
        $_POST['price'],
        $_FILES['image']['name'],
        $_POST['id']
    ];
    updateProduct($product_details);
}
?>


<section class="edit-product">
    <form action="" method="POST" enctype="multipart/form-data">
        <h3>Edit the product</h3>
        <input type="hidden" name="id" value="<?= $id; ?>">
        <p>product name <span>*</span></p>
        <input type="text" name="name" required maxlength="50" placeholder="enter product name" value="<?= $name ?>" class="box">
        <p>product price <span>*</span></p>
        <input type="number" name="price" required maxlength="10" min="0" max="9999999999" placeholder="enter product price" value="<?= $price ?>" class="box">
        <p>product image <span>*</span></p>
        <input type="file" name="image" accept="image/*" value="<?= $image ?>" class="box">
        <input type="submit" value="edit product" name="edit_product" class="btn">
    </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</body>
</html>
