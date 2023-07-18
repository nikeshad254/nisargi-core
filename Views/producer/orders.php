<div class="first-hero container">

    <div class="nav-btns">
        <h3 class="heading">Filters:</h3>
        <form action="" method="get">
            <button type="submit" name="type" value="active" class="btn <?php if ((isset($_GET['type']) && ($_GET['type'] == 'active' || $_GET['type'] == '')) || !isset($_GET['type'])) {
                                                                            echo 'active';
                                                                        } ?>">Active Order</button>
            <button type="submit" name="type" value="delivery" class="btn <?php if (isset($_GET['type']) && $_GET['type'] == 'delivery') {
                                                                                echo 'active';
                                                                            } ?>">In Delivery</button>
            <button type="submit" name="type" value="completed" class="btn <?php if (isset($_GET['type']) && $_GET['type'] == 'completed') {
                                                                                echo 'active';
                                                                            } ?>">Completed</button>
            <button type="submit" name="type" value="canceled" class="btn <?php if (isset($_GET['type']) && $_GET['type'] == 'canceled') {
                                                                                echo 'active';
                                                                            } ?>">Canceled</button>
        </form>
    </div>

    <div class="headers">
        <h3 class="heading">
            <?php
            if (isset($_GET['type'])) {
                $type = $_GET['type'];
                $name = ($type == 'active' || $type == '') ? 'Active' : (
                    ($type == 'delivery') ? 'In Delivery' : (
                        ($type == 'completed') ? 'Completed' : (
                            ($type == 'canceled') ? 'Canceled' : ''
                        )));
                echo $name;
            } else {
                echo 'Active';
            }
            ?> Orders</h3>
    </div>

    <table class="order-container">
        <thead>
            <th>Order</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Phone</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php
            if (empty($orders)) {
                echo '<tr><td colspan="6"> There are no approved orders ... </td></tr>';
            } else {
            ?>
                <?php foreach ($orders as $order) : ?>
                    <tr>

                        <td>
                            <a href="./shoporder?id=<?= $order->order_id; ?>">#<?= $order->order_id; ?></a>
                        </td>
                        <td><?= $order->date; ?></td>
                        <td>
                            <p><?= $order->delivery_name; ?></p>
                            <p><?= $order->city; ?> , <?= $order->street; ?></p>
                        </td>
                        <td>
                            <?php foreach ($order->products as $product) : ?>
                                <p><?= $product['product_name']; ?> - <?= $product['quantity']; ?> </p>
                            <?php endforeach; ?>
                        </td>
                        <td><?= $order->mobile; ?></td>
                        <td>
                            <div class="status <?= ($order->status == 'in review') ? 'inreview' : (($order->status == 'in delivery') ? 'indelivery' : $order->status); ?>">
                                <small><?= $order->status; ?></small>
                                <span class="dot blinking1"></span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } ?>

        </tbody>

    </table>

</div>

<?php
$pagePath = "./shoporders";
include "Views/paging.php";
?>