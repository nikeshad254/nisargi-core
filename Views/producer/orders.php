<div class="first-hero container">

    <div class="headers">
        <h3 class="heading">Active Orders</h3>
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
            if (empty($approvedOrders)) {
                echo '<tr><td colspan="6"> There are no approved orders ... </td></tr>';
            } else {
            ?>
            <?php foreach($approvedOrders as $order):?>
                <tr>
                    <td>#<?=$order->order_id;?></td>
                    <td><?=$order->date;?></td>
                    <td>
                        <p><?=$order->delivery_name;?></p>
                        <p><?=$order->city;?> , <?=$order->street;?></p>
                    </td>
                    <td>
                        <?php foreach($order->products as $product):?>
                            <p><?= $product['product_name'];?> - <?= $product['quantity'];?> </p>
                        <?php endforeach;?>
                    </td>
                    <td><?=$order->mobile;?></td>
                    <td>
                        <div class="status <?= ($order->status == 'in review')? 'inreview': (($order->status == 'in delivery')? 'indelivery': $order->status); ?>">
                            <small><?=$order->status;?></small>
                            <span class="dot blinking1"></span>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php } ?>

        </tbody>

    </table>

</div>

<div class="contianer orderBelow">

    <div class="headers">
        <h3 class="heading">Orders In Delivery</h3>
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
            <tr>
            <?php
            if (empty($inDeliveryOrders)) {
                echo '<tr><td colspan="6"> There are no orders ... </td></tr>';
            } else {
            ?>
            <?php foreach($inDeliveryOrders as $order):?>
                <tr>
                    <td>#<?=$order->order_id;?></td>
                    <td><?=$order->date;?></td>
                    <td>
                        <p><?=$order->delivery_name;?></p>
                        <p><?=$order->city;?> , <?=$order->street;?></p>
                    </td>
                    <td>
                        <?php foreach($order->products as $product):?>
                            <p><?= $product['product_name'];?> - <?= $product['quantity'];?> </p>
                        <?php endforeach;?>
                    </td>
                    <td><?=$order->mobile;?></td>
                    <td>
                        <div class="status <?= ($order->status == 'in review')? 'inreview': (($order->status == 'in delivery')? 'indelivery': $order->status); ?>">
                            <small><?=$order->status;?></small>
                            <span class="dot blinking1"></span>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php } ?>
            </tr>

        </tbody>

    </table>
</div>

<div class="contianer orderBelow">

    <div class="headers">
        <h3 class="heading">Completed Orders</h3>
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
            <tr>
            <?php
            if (empty($completedOrders)) {
                echo '<tr><td colspan="6"> There are no orders ... </td></tr>';
            } else {
            ?>
            <?php foreach($completedOrders as $order):?>
                <tr>
                    <td>#<?=$order->order_id;?></td>
                    <td><?=$order->date;?></td>
                    <td>
                        <p><?=$order->delivery_name;?></p>
                        <p><?=$order->city;?> , <?=$order->street;?></p>
                    </td>
                    <td>
                        <?php foreach($order->products as $product):?>
                            <p><?= $product['product_name'];?> - <?= $product['quantity'];?> </p>
                        <?php endforeach;?>
                    </td>
                    <td><?=$order->mobile;?></td>
                    <td>
                        <div class="status <?= ($order->status == 'in review')? 'inreview': (($order->status == 'in delivery')? 'indelivery': $order->status); ?>">
                            <small><?=$order->status;?></small>
                            <span class="dot blinking1"></span>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php } ?>
            </tr>

        </tbody>

    </table>
</div>

<div class="contianer orderBelow">

    <div class="headers">
        <h3 class="heading">Canceled Orders</h3>
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
            <tr>
            <?php
            if (empty($canceledOrders)) {
                echo '<tr><td colspan="6"> There are no orders ... </td></tr>';
            } else {
            ?>
            <?php foreach($canceledOrders as $order):?>
                <tr>
                    <td>#<?=$order->order_id;?></td>
                    <td><?=$order->date;?></td>
                    <td>
                        <p><?=$order->delivery_name;?></p>
                        <p><?=$order->city;?> , <?=$order->street;?></p>
                    </td>
                    <td>
                        <?php foreach($order->products as $product):?>
                            <p><?= $product['product_name'];?> - <?= $product['quantity'];?> </p>
                        <?php endforeach;?>
                    </td>
                    <td><?=$order->mobile;?></td>
                    <td>
                        <div class="status <?= ($order->status == 'in review')? 'inreview': (($order->status == 'in delivery')? 'indelivery': $order->status); ?>">
                            <small><?=$order->status;?></small>
                            <span class="dot blinking1"></span>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php } ?>
            </tr>

        </tbody>

    </table>
</div>