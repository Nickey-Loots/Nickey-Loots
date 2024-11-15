<?php $orders = getAllOrders(); ?>
<?php isLoggedIn('/?page=login'); ?>

    <section class="orders">
        <h3 class="heading">Manage Orders</h3>
        <table class="order_table">
            <tr class="table_row">
                <th class="table_head">Customer name</th>
                <th class="table_head">Price</th>
                <th class="table_head">Quantity</th>
                <th class="table_head">Status</th>
                <th class="table_head"></th>
            </tr>
            <?php if (count($orders) > 0) : ?>
                <?php foreach ($orders as $row) : ?>
                    <tr class="table_row">
                        <td class="table_cell"><?= $row['name'] ?></td>
                        <td class="table_cell"><?= $row['price'] ?></td>
                        <td class="table_cell"><?= $row['qty'] ?></td>
                        <td class="table_cell"><?= $row['status'] ?></td>
                        <td class="table_cell">
                            <a href="./?page=orderDetails&id=<?= $row['id'] ?>" class="btn">More Details</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan='5'>No orders found.</td>
                </tr>
            <?php endif ?>
        </table>
    </section>