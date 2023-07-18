<div class="first-hero container">
    <?php

    ?>
    <h3 class="heading">Dashboard</h3>
    <div class="blocks">
        <div class="sales block">
            <div class="desc">
                <p class="amt">Rs.<?= $overAllData->total_sum; ?></p>
                <p class="name">total sales</p>
            </div>
            <img src="Views/images/icons/cart.svg" alt="" class="image">
        </div>

        <div class="block">
            <div class="desc">
                <p class="amt"><?= $overAllData->total_orders; ?></p>
                <p class="name">total orders</p>
            </div>
            <img src="Views/images/icons/queue-list.svg" alt="" class="image">
        </div>

        <div class="block">
            <div class="desc">
                <p class="amt"><?= $overAllData->total_unique_users; ?></p>
                <p class="name">Customers</p>
            </div>
            <img src="Views/images/icons/user-circle.svg" alt="" class="image">
        </div>

        <div class="block">
            <div class="desc">
                <p class="amt"><?= $avgRating; ?></p>
                <p class="name">Avg. Rating</p>
            </div>
            <?php
            if ($avgRating - $avgRating % 10 != 0) {
                echo '<img src="Views/images/icons/ystar-half.svg" alt="" class="image">';
            } elseif ($avgRating > 0) {
                echo '<img src="Views/images/icons/ystar-fill.svg" alt="" class="image">';
            } else {
                echo '<img src="Views/images/icons/ystar.svg" alt="" class="image">';
            }
            ?>
        </div>
    </div>
</div>

<div class="general-orders container">
    <h3 class="heading">General Orders</h3>
    <table class="order-table">
        <thead>
            <tr>
                <th rowspan="2">Order</th>
                <th rowspan="2">Date</th>
                <th rowspan="2">Buyer Name</th>
                <th colspan="3">Product</th>
                <th rowspan="2">Amount</th>
                <th rowspan="2">Status</th>
            </tr>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // echo "<pre>";
            // print_r($tableData);
            foreach ($tableData as $order) :
                $rowSpan = count($order->products);
                $total = 0;

                foreach($order->products as $product){
                    $total += $product['price'] * $product['quantity'];
                }
                // echo $rowSpan;
            ?>
                <tr>
                    <td rowspan="<?= $rowSpan ?>"><?= $order->order_id; ?></td>
                    <td rowspan="<?= $rowSpan ?>"><?= $order->date; ?></td>
                    <td rowspan="<?= $rowSpan ?>"><?= $order->delivery_name; ?></td>
                    <!-- product -->
                    <td><?= $order->products[0]['product_name'] ?></td>
                    <td><?= $order->products[0]['price'] ?></td>
                    <td><?= $order->products[0]['quantity'] ?></td>
                    <!-- product -->
                    <td rowspan="<?= $rowSpan ?>"><?=$total?></td>
                    <td rowspan="<?= $rowSpan ?>"><?= $order->status; ?></td>
                </tr>

                <!-- product count -1  -->
                <?php for ($i = 1; $i < $rowSpan; $i++) : ?>
                    <tr>
                        <td><?= $order->products[$i]['product_name'] ?></td>
                        <td><?= $order->products[$i]['price'] ?></td>
                        <td><?= $order->products[$i]['quantity'] ?></td>
                    </tr>
                <?php endfor; ?>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>