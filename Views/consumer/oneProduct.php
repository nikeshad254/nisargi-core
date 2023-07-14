<div class="labels container">
    <!-- <a href="#">All</a><span>></span><a href="#">Fruits</a><span> -->
    <?php
    if (empty($product) || $product == null) {
        echo "<h4 style='text-align: center;'>Product Not Found !! </h4>";
        exit;
    }

    function findQty($cartDatas, $productId)
    {
        $foundProduct = null;

        foreach ($cartDatas as $cartItem) {
            if ($cartItem['productId'] == $productId) {
                $foundProduct = $cartItem;
                break;
            }
        }

        if ($foundProduct) {
            $quantity = $foundProduct['quantity'];
            return $quantity;
        } else {
            return 0;
        }
    }
    ?>
</div>

<div class="container product-view">
    <div class="image-container">
        <img src="uploads/products/<?= $product->image; ?>" alt="">
    </div>
    <div class="details-container">
        <h3 class="product"><?= $product->name; ?></h3>
        <p class="seller">Seller: <a href="./consumer-producer.html" class="link"><?= $product->shop_name; ?></a></p>
        <p class="description"><?= $product->description; ?></p>
        <div class="stars-and-award">
            <div class="stars">

                <?php $rating = ($product->avg_rating == null) ? 0 : round($product->avg_rating * 2) / 2;; ?>
                <div class="stars-collection">
                    <?php

                    $count = floor($rating); // Get the integer part of the rating
                    $hasHalfStar = false; // Flag to track if a half star should be displayed

                    if ($rating - $count >= 0.5) {
                        $hasHalfStar = true; // Set the flag if the decimal part is greater than or equal to 0.5
                    }

                    for ($i = 1; $i <= 5; $i++) {
                        if ($count > 0) {
                            echo '<img src="Views/images/icons/ystar-fill.svg" alt="" class="icons">';
                            $count--;
                        } elseif ($hasHalfStar) {
                            echo '<img src="Views/images/icons/ystar-half.svg" alt="" class="icons">';
                            $hasHalfStar = false; // Display the half star only once
                        } else {
                            echo '<img src="Views/images/icons/ystar.svg" alt="" class="icons">';
                        }
                    }

                    ?>
                </div>
                <small>(<?= $product->review_count; ?>)</small>
            </div>

            <?php if ($product->avg_rating > 20) { ?>
                <div class="seller-award">
                    <img src="Views/images/icons/cloudTick.svg" alt="" class="icons">
                    <p>Best Seller</p>
                </div>
            <?php } ?>
        </div>

        <p class="price">Rs. <?= $product->price; ?></p>
        <div class="stockQty">
            <div class="qtys">
                <div class="qty">
                    <p onclick="decrement(<?= $product->id ?>)">-</p>
                    <div class="incrementer" id="incrPlace">
                        <?php
                        if (!empty($cartDatas) && findQty($cartDatas, $product->id) > 0) {
                            echo findQty($cartDatas, $product->id);
                        } else {
                            echo 1;
                        }
                        ?>
                    </div>
                    <p onclick="increment(<?= $product->id ?>)">+</p>
                </div>

                <p class="unit"><?= $product->unit; ?></p>
            </div>
            <p class="stock">Stock: <span id="pStock"><?= $product->stock; ?></span> <?= $product->unit; ?></p>
        </div>

        <div class="buyCartBtn">
            <button class="btn" id="buyOneProduct">
                Buy Now
            </button>
            <button class="btn" id="addOneCart" name="productBtn<?= $product->id; ?>">
                Add to Cart
            </button>
        </div>

    </div>
</div>


<div class="reviews-section container">
    <div class="avgReview">
        <div class="stars">


            <div class="stars-collection">
                <?php

                $count = floor($rating); // Get the integer part of the rating
                $hasHalfStar = false; // Flag to track if a half star should be displayed

                if ($rating - $count >= 0.5) {
                    $hasHalfStar = true; // Set the flag if the decimal part is greater than or equal to 0.5
                }

                for ($i = 1; $i <= 5; $i++) {
                    if ($count > 0) {
                        echo '<img src="Views/images/icons/ystar-fill.svg" alt="" class="icons">';
                        $count--;
                    } elseif ($hasHalfStar) {
                        echo '<img src="Views/images/icons/ystar-half.svg" alt="" class="icons">';
                        $hasHalfStar = false; // Display the half star only once
                    } else {
                        echo '<img src="Views/images/icons/ystar.svg" alt="" class="icons">';
                    }
                }

                ?>
            </div>

            <small><?= $rating ?> : Average Rating</small>
        </div>
    </div>
    <h3>Reviews for this product <span>(<?= $product->review_count; ?>)</span></h3>

    <div class="reviewsContainer">
        <?php foreach ($reviews as $review) : ?>
            <div class="one-review">
                <div class="stars-n-more">
                    <div class="stars-collection">
                        <?php
                        $count = $review->rating;
                        for ($i = 1; $i <= 5; $i++) {
                            if ($count > 0) {
                                echo '<img src="Views/images/icons/ystar-fill.svg" alt="" class="icons">';
                            } else {
                                echo '<img src="Views/images/icons/ystar.svg" alt="" class="icons">';
                            }
                            $count--;
                        }
                        ?>
                    </div>
                    <!-- <img src="Views/images/icons/3dots.svg" alt="" class="icons"> -->
                </div>
                <div class="profile-name">
                    <img class="profile-img" src="uploads/<?= $review->reviewer_pic; ?>" alt="">
                    <h3 class="name"><?= $review->reviewer_name; ?></h3>
                    <p class="date"><?= $review->review_date; ?></p>
                </div>
                <p class="reviewPara">
                    <?= $review->review_msg; ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    $pagePath = './product';
    include 'Views/paging.php'
    ?>
</div>

<div class="more-shop container">
    <h3>More from this shop:</h3>
    <div class="one-product-collection">
        <!-- max seven -->
        <?php foreach ($shopProducts as $product) : ?>
            <a href="./product?id=<?= $product->id; ?>" class="one-more-product link">
                <img class="img" src="uploads/products/<?= $product->image; ?>" alt="">
                <p class="productEn"><?= $product->name; ?></p>
                <p class="price">Rs. <?= $product->price; ?></p>
            </a>
        <?php endforeach; ?>

        <a href="#" class="view-more link">
            <img src="Views/images/icons/arrow.svg" alt="">
            <p>See All</p>
        </a>

    </div>
</div>

<div class="more-shop container">
    <h3>Products you may like:</h3>
    <div class="one-product-collection">
        <!-- max seven -->
        <?php foreach ($similarProducts as $product) : ?>
            <a href="./product?id=<?= $product->id; ?>" class="one-more-product link">
                <img class="img" src="uploads/products/<?= $product->image; ?>" alt="">
                <p class="productEn"><?= $product->name; ?></p>
                <p class="price">Rs. <?= $product->price; ?></p>
            </a>
        <?php endforeach; ?>

        <div class="view-more">
            <img src="Views/images/icons/arrow.svg" alt="">
            <p>See All</p>
        </div>

    </div>
</div>

<script src="Views/consumer/js/oneProduct.js"></script>