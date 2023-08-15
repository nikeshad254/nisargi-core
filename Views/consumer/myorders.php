<section class="first-one">
    <div class="items-container">
        <h3 class="heading">On Delivery:</h3>

        <?php
        // echo '<pre>';

        function findTotalPrice($products){
            $sum = 0;
            foreach($products as $product){
                $sum += $product['price']*$product['quantity'];
            }
            return $sum;
        }
        // print_r($inDelivery);
        // print_r($allOrders);
        // print_r($allReviews);

        if (count($inDelivery) < 1) {
            echo "<p> There are no orders in delivery </p>";
        }
        ?>

        <?php foreach ($inDelivery as $orders) : ?>
            <div class="item">
                <a href="./viewshop?id=<?=$orders->shop_id?>" class="shop-name link">
                    <h3><?= $orders->shop_name; ?></h3>
                </a>

                <div class="order-date">
                    <h3><?= $orders->date; ?></h3>
                </div>

                <div class="products">
                    <?php $total = 0;
                    foreach ($orders->products as $product) :
                        $total += $product['quantity'] * $product['price'];
                    ?>
                        <div class="one-product">
                            <img src="uploads/products/<?= $product['product_image']; ?>" class="product-img" alt="">
                            <a href="./product?id=<?=$product['id'];?>" class="product-name link"><?= $product['product_name']; ?></a>
                            <p class="product-qty"><?= $product['quantity']; ?> <?= $product['unit']; ?></p>
                        </div>

                    <?php endforeach; ?>
                </div>

                <div class="total-order">
                    <h3>Rs. <?= $total; ?></h3>
                </div>

                <div class="approve">
                    <p>Has Delivery Arrived?</p>
                    <a href="./billview?id=<?= $orders->order_id; ?>" class="btn">Click To Approve!</a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>

<div class="history container">
    <h3 class="heading">Order History: </h3>

    <div class="orders-list">

        <?php 
            if(count($allOrders) < 1){
                echo "<p>There are no Orders...</p>";
            }
        foreach ($allOrders as $orders) : 
            ?>
            <div class="singleOrder">
                <div class="productContainer">
                    <div class="purchase-txt">
                        <p>Purchased from <a href="./viewshop?id=<?= $orders->shop_id; ?>"><?= $orders->shop_name; ?></a> on <?= $orders->date; ?></p>
                        <p>Rs. <?=findTotalPrice($orders->products);?></p>
                    </div>

                    <div class="products">
                        <?php
                        foreach ($orders->products as $product) :
                            $review = $this->getReview($product['id'], $orders->user_id, $allReviews);
                            // print_r($review);
                        ?>
                            <div class="one-product">
                                <div class="product-img">
                                    <img src="uploads/products/<?= $product['product_image'] ?>" alt="">
                                </div>

                                <div class="review">
                                    <div class="top">
                                        <a href="./product?id=<?=$product['id']?>" class="product-name link"><?= $product['product_name'] ?></a>
                                        <div class="stars">
                                            <?php
                                            if (empty($review)) {
                                                for ($i = 1; $i <= 5; $i++) {
                                                    echo '<b>&star;</b>';
                                                }
                                            } else {
                                                $count = $review->rating;
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($count > 0) {
                                                        echo '<b>&starf;</b>';
                                                    } else {
                                                        echo '<b>&star;</b>';
                                                    }
                                                    $count--;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <p class="message">
                                        <?php
                                        echo (empty($review)) ? 'Leave a review.' : $review->review_msg;
                                        ?>
                                    </p>

                                    <a href="./givereview?id=<?= $product['id'] ?>&item=product">Edit review</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="description">
                    <h3 class="heading"><?= $orders->status; ?></h3>
                    <p>On <?= $orders->date; ?></p>
                    <p>From <?= $orders->city; ?>, <?= $orders->street; ?></p>

                    <a href="./billview?id=<?= $orders->order_id; ?>" class="btn">
                        View Order
                    </a>

                    <a href="./viewshop?id=<?= $orders->shop_id; ?>" class="btn">
                        View Shop
                    </a>

                    <a href="./givereview?id=<?= $orders->shop_id; ?>&item=shop" class="btn">
                        Review Shop
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>