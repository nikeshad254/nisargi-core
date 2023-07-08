<section class="first-one">
    <div class="items-container">
        <h3 class="heading">On Delivery:</h3>

        <?php
        if(count($inDelivery)<1){
            echo "<p> There are no orders in delivery </p>";
        }
        ?>

        <?php foreach($inDelivery as $orders):?>
        <div class="item">
            <div class="shop-name">
                <h3><?= $orders->shop_name;?></h3>
            </div>

            <div class="order-date">
                <h3><?= $orders->date;?></h3>
            </div>

            <div class="products">
                <?php $total = 0;
                foreach($orders->products as $product):
                    $total += $product['quantity']*$product['price'];
                ?>
                <div class="one-product">
                    <img src="uploads/products/<?=$product['product_image'];?>" class="product-img" alt="">
                    <p class="product-name"><?= $product['product_name'];?></p>
                    <p class="product-qty"><?= $product['quantity'];?> <?= $product['unit'];?></p>
                </div>
                
                <?php endforeach;?>
            </div>

            <div class="total-order">
                <h3>Rs. <?= $total;?></h3>
            </div>

            <div class="approve">
                <p>Has Delivery Arrived?</p>
                <a href="./billview?id=<?=$orders->order_id;?>" class="btn">Click To Approve!</a>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</section>

<div class="history container">
    <h3 class="heading">Order History: </h3>

    <table>
        <thead>
            <th>Order</th>
            <th>Status</th>
            <th>Shop Name</th>
            <th>Ordered Date</th>
            <th>Products</th>
            <th>Total Price</th>
            <th>Action</th>
        </thead>

        <tbody>
            <?php
                if(count($allOrders) < 1){
                    echo "<p> There are no orders. </p>";
                    exit;
                }
                foreach($allOrders as $order):
            ?>
            <tr>
                <td>#<?=$order->order_id;?></td>
                <td><?=$order->status;?></td>
                <td><?=$order->shop_name;?></td>
                <td><?=$order->date;?></td>
                <td>
                    <?php 
                    $total = 0;
                    foreach($order->products as $product):
                        $total += $product['quantity']*$product['price'];
                    ?>
                    <p><?=$product['product_name'];?>- <?=$product['quantity'];?> <?=$product['unit'];?></p>
                    <?php endforeach;?>
                </td>
                <td>Rs. <?=$total;?></td>
                <td>
                    <a href="./billview?id=<?=$order->order_id;?>" class="btn">View</a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>