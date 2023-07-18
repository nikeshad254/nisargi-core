<div class="first-hero container">

    <?php
    if (empty($reviews)) {
        echo 'no reviews found';
        exit;
    }
    // print_r($reviews);

    $type = ($tblname == 'product_review_view' ? 'product' : ($tblname == 'shop_review_view' ? 'shop' : ''));

    $avg_rating = round($avg_rating * 2) / 2;

    ?>

    <div class="header">
        <h3 class="heading">Reviews of <?= $type ?></h3>

        <form action="" class="buttons" method="get">
            <small>click to change view: </small>

            <input type="submit" name="type" value="product" class="btn">
            <input type="submit" name="type" value="shop" class="btn">
        </form>
    </div>

    <div class="cards">
        <div class="review card">
            <p class="title">Total <?= $type; ?> Review</p>
            <p><?= count($reviews); ?></p>
        </div>

        <div class="rating card">
            <p class="title">Average <?= $type; ?> Rating</p>
            <div class="rate-star">
                <p><?= $avg_rating; ?></p>
                <div class="stars">
                    <?php

                    $count = floor($avg_rating); // Get the integer part of the rating
                    $hasHalfStar = false; // Flag to track if a half star should be displayed

                    if ($avg_rating - $count >= 0.5) {
                        $hasHalfStar = true; // Set the flag if the decimal part is greater than or equal to 0.5
                    }

                    for ($i = 1; $i <= 5; $i++) {
                        if ($count > 0) {
                            echo '<img src="Views/images/icons/ystar-fill.svg" alt="" class="star">';
                            $count--;
                        } elseif ($hasHalfStar) {
                            echo '<img src="Views/images/icons/ystar-half.svg" alt="" class="star">';
                            $hasHalfStar = false; // Display the half star only once
                        } else {
                            echo '<img src="Views/images/icons/ystar.svg" alt="" class="star">';
                        }
                    }

                    ?>
                </div>
            </div>
        </div>

    </div>
</div>

<h3 class="heading container"><?= $type; ?> Reviews (<?= count($reviews) ?>)</h3>
<div class="container reviewsContainer">
    <?php foreach ($reviews as $review) : ?>
        <div class="one-review">
            <div class="profile-img">
                <img src="uploads/<?= ($type == 'product') ? $review->reviewer_pic : $review->reviewer_img; ?>" alt="">
            </div>
            <div class="profile-name">
                <h3 class="name"><?= $review->reviewer_name; ?></h3>
                <p class="date"><?= ($type == 'product') ? $review->review_date : $review->review_on; ?></p>
                <p class="productName">Product: <?= ($type == 'product') ? $review->product_name : $review->shop_name; ?></p>
            </div>
            <div class="para-stars">
                <div class="stars">
                    <?php
                    $count = $review->rating;
                    for ($i = 1; $i <= 5; $i++) {
                        if ($count > 0) {
                            echo '<img src="Views/images/icons/ystar-fill.svg" alt="" class="star">';
                        } else {
                            echo '<img src="Views/images/icons/ystar.svg" alt="" class="star">';
                        }
                        $count--;
                    }
                    ?>
                </div>
                <p><?= $review->review_msg; ?></p>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<?php
$pagePath = './viewreviews';

include 'Views/paging.php';

?>