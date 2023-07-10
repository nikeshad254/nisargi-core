<section class="first-one">
    <div class="items-container">
        <h3 class="heading">On Delivery:</h3>

        <?php
        if (count($inDelivery) < 1) {
            echo "<p> There are no orders in delivery </p>";
        }
        ?>

        <?php foreach ($inDelivery as $orders) : ?>
            <div class="item">
                <div class="shop-name">
                    <h3><?= $orders->shop_name; ?></h3>
                </div>

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
                            <p class="product-name"><?= $product['product_name']; ?></p>
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


        <div class="singleOrder">
            <div class="productContainer">
                <div class="purchase-txt">
                    <p>Purchased from <a href="#">Raju shop</a> on 1020-02-02</p>
                    <p>Rs. 1092</p>
                </div>

                <div class="products">
                    <div class="one-product">
                        <div class="product-img">
                            <img src="uploads/products/Dahi_20230614110552.png" alt="">
                        </div>

                        <div class="review">
                            <div class="top">
                                <p class="product-name">Product Name</p>
                                <div class="stars">
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&star;</b>
                                    <b>&star;</b>
                                </div>
                            </div>

                            <p class="message">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos doloribus excepturi asperiores accusamus nam eligendi. Dolores hic iste illum, dolor numquam illo sapiente iure.
                            </p>

                            <a href="#">Edit review</a>
                        </div>
                    </div>


                    <div class="one-product">
                        <div class="product-img">
                            <img src="uploads/products/Dahi_20230614110552.png" alt="">
                        </div>

                        <div class="review">
                            <div class="top">
                                <p class="product-name">Product Name</p>
                                <div class="stars">
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&star;</b>
                                    <b>&star;</b>
                                </div>
                            </div>

                            <p class="message">
                                Leave a review.
                            </p>

                            <a href="#">Add review</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="description">
                <h3 class="heading">Status</h3>
                <p>On 2020-02-02</p>
                <p>From Delivery, Address</p>

                <a href="#" class="btn">
                    View Order
                </a>

                <a href="#" class="btn">
                    View Shop
                </a>

                <a href="#" class="btn">
                    Review Shop
                </a>
            </div>
        </div>

        <div class="singleOrder">
            <div class="productContainer">
                <div class="purchase-txt">
                    <p>Purchased from <a href="#">Raju shop</a> on 1020-02-02</p>
                    <p>Rs. 1092</p>
                </div>

                <div class="products">
                    <div class="one-product">
                        <div class="product-img">
                            <img src="uploads/products/Dahi_20230614110552.png" alt="">
                        </div>

                        <div class="review">
                            <div class="top">
                                <p>Your Review</p>
                                <div class="stars">
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&star;</b>
                                    <b>&star;</b>
                                </div>
                            </div>

                            <p class="message">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos doloribus excepturi asperiores accusamus nam eligendi. Dolores hic iste illum, dolor numquam illo sapiente iure.
                            </p>

                            <a href="#">Edit review</a>
                        </div>
                    </div>


                    <div class="one-product">
                        <div class="product-img">
                            <img src="uploads/products/Dahi_20230614110552.png" alt="">
                        </div>

                        <div class="review">
                            <div class="top">
                                <p class="product-name">Product Name</p>
                                <div class="stars">
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&star;</b>
                                    <b>&star;</b>
                                </div>
                            </div>

                            <p class="message">
                                Leave a review.
                            </p>

                            <a href="#">Add review</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="description">
                <h3 class="heading">Status</h3>
                <p>On 2020-02-02</p>
                <p>From Delivery, Address</p>

                <a href="#" class="btn">
                    View Order
                </a>
            </div>
        </div>

        <div class="singleOrder">
            <div class="productContainer">
                <div class="purchase-txt">
                    <p>Purchased from <a href="#">Raju shop</a> on 1020-02-02</p>
                    <p>Rs. 1092</p>
                </div>

                <div class="products">
                    <div class="one-product">
                        <div class="product-img">
                            <img src="uploads/products/Dahi_20230614110552.png" alt="">
                        </div>

                        <div class="review">
                            <div class="top">
                                <p>Your Review</p>
                                <div class="stars">
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&star;</b>
                                    <b>&star;</b>
                                </div>
                            </div>

                            <p class="message">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos doloribus excepturi asperiores accusamus nam eligendi. Dolores hic iste illum, dolor numquam illo sapiente iure.
                            </p>

                            <a href="#">Edit review</a>
                        </div>
                    </div>


                    <div class="one-product">
                        <div class="product-img">
                            <img src="uploads/products/Dahi_20230614110552.png" alt="">
                        </div>

                        <div class="review">
                            <div class="top">
                                <p class="product-name">Product Name</p>
                                <div class="stars">
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&starf;</b>
                                    <b>&star;</b>
                                    <b>&star;</b>
                                </div>
                            </div>

                            <p class="message">
                                Leave a review.
                            </p>

                            <a href="#">Add review</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="description">
                <h3 class="heading">Status</h3>
                <p>On 2020-02-02</p>
                <p>From Delivery, Address</p>

                <a href="#" class="btn">
                    View Order
                </a>
            </div>
        </div>
    </div>
</div>