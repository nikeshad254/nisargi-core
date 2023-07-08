<div class="first-hero container">
    <?php 
        if(empty($order)){
            echo '<p> Bill not found. </p>';
            exit;
        }
    ?>
    <div class="orderBill">
        <div class="top-header">
            <h2 class="heading"><?=$order->shop_name;?>'s Bill</h2>
        </div>
        <div class="headers">
            <h3 class="heading">Order: #<?=$order->order_id;?></h3>
            <p>Date: <?=$order->date;?></p>
        </div>
        <p class="orderInfo">Order By: <?=$order->delivery_name;?></p>
        <p class="orderInfo">Order In: <?=$order->city;?>, <?=$order->street;?></p>

        <p class="products orderInfo">Products:</p>
        <div class="orders">
            <?php 
            $total = 0;
            foreach($order->products as $product): 
                $total += $product['price']*$product['quantity'];
            ?>

            <div class="oneOrder">
                <img src="uploads/products/<?=$product['product_image'];?>" alt="">
                <p class="name"><?=$product['product_name'];?></p>
                <div class="prodQty">
                    <p>Rs. <?=$product['price'];?></p>
                    <p><?=$product['quantity'];?> <?=$product['unit'];?></p>
                    <h3>Rs. <?=$product['price']*$product['quantity'];?></h3>
                </div>
            </div>

            <?php endforeach;?>
        </div>

        <div class="total container">
            <p>Total:</p>
            <p>Rs. <?=$total;?></p>
        </div>
        <div class="buttons">
            <a href="./myorders" class="btn">Back</a>
            <?php
                if($order->status == 'in delivery'){
                    echo '<a href="./approveorder?id='.$order->order_id.'" class="btn">Approve Order</a>';
                }else{
                    echo 'status: order '.$order->status;
                }
            ?>
        </div>
    </div>

</div>