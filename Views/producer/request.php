<div class="first-hero container">
    <h3 class="heading">Active Requests</h3>

    <?php
    if (count($orders) < 1) {
        echo "<p>There Are No Active Requests</p>";
        exit;
    }

    ?>

    <div class="all-requests">
        <?php foreach ($orders as $request) : ?>
            <a href="./viewrequest?id=<?=$request->order_id?>" class="one-request Link">
                <div class="left-side">
                    <img src="uploads/<?=$request->photo;?>" alt="" class="image">
                    <p class="person"><?=$request->delivery_name;?></p>
                    <p><?=$request->city;?>, <?=$request->street;?></p>
                    <p><?=$request->mobile;?></p>
                </div>
                <div class="right-side">
                    <div class="products">
                        <?php 
                        $sum = 0;
                        foreach($request->products as $product):
                            $sum += $product['price'] * $product['quantity'];
                        ?>
                        <p><span><?=$product['product_name'];?>:</span> <span><?=$product['quantity'];?></span></p>
                        <?php endforeach;?>
                    </div>
                    <p class="total"><span>Total:</span> <span>Rs.<?=$sum;?></span></p>
                </div>
            </a>
        <?php endforeach; ?>

    </div>
</div>