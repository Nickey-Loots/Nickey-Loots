<?php $products = products(); ?>
<?php if (isset($_POST['delete'])) : ?>
    <?php delete(); ?>
<?php endif ?>

<section class="products">
    <h3 class="heading">Manage Products</h3>
    <table class="product_table">
        <tr class="table_row">
            <th class="table_head">name</th>
            <th class="table_head">price</th>
            <th class="table_head">action</th>
        </tr>

        <?php foreach ($products as $product) : ?>
            <tr class="table_row">
                <td class="table_cell"><?= $product['name'] ?></td>
                <td class="table_cell"><?= $product['price'] ?></td>
                <td class="table_cell">
                    <div class="action-buttons">
                        <a href="./?page=editProduct&edit_id=<?= $product['id'] ?>"><i class="fas fa-edit"></i></a>
                        <form action="" method="post" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            <input type="hidden" name="delete_id" value="<?= $product['id'] ?>">
                            <button type="submit" name="delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <div class="link">
        <a href="/admin/?page=addProduct">Add Product</a>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</body>

</html>