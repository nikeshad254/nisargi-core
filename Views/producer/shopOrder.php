<div class="first-hero container">
    <?php
    if (empty($order)) {
        echo "<p>Order Not Found !!!</p>";
        exit;
    }
    $order = $order[0];
    $total =  0;
    // echo '<pre>';
    // print_r($order);
    ?>
    <div class="orderBill">
        <div class="headers">
            <h3 class="heading">Order #<?= $order->order_id; ?></h3>
            <p>Date: <?= $order->date; ?></p>
        </div>
        <p class="orderInfo"><?= $order->delivery_name; ?></p>
        <p class="orderInfo"><?= $order->city; ?>, <?= $order->street; ?></p>

        <p class="products orderInfo">Products:</p>
        <div class="orders">
            <?php
            foreach ($order->products as $product) :
                $total += $product['price'] * $product['stock'];
            ?>
                <div class="oneOrder">
                    <img src="uploads/products/<?= $product['product_image'] ?>" alt="">
                    <p class="name"><?= $product['product_name']; ?></p>
                    <div class="prodQty">
                        <h4>Rs. <?= $product['price']; ?></h4>
                        <p><?= $product['stock']; ?> <?= $product['unit']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="total container">
            <p>Total:</p>
            <p>Rs. <?= $total; ?></p>
        </div>
        <div class="buttons">
            <a href="./shoporders" class="btn">Back</a>
            <?php if ($order->status == "approved") {
                echo '<a href="./setdelivery?id='.$order->order_id.'" class="btn">Deliver Now</a>';
            } else {
                echo "<p>Current Status: ".$order->status."</p>";
            }
            ?>
        </div>
    </div>

</div>