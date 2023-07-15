<div class="first-hero container">
    <?php
    if(empty($shop)){
        echo '<h3>Shop not found!</h3>';
        exit;
    }
    ?>

    <h3>Raju Kumar Pasal </h3>

    <div class="shop-info">
        <div class="img-address">
            <img src="uploads/<?=$shop->image;?>" alt="">
            <p><?=$shop->address;?></p>
        </div>
        <div class="text-bio">

            <div class="tagline block">
                <h3 class="title">Tagline:</h3>
                <p>"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam quas at accusantium adipisci aliquid distinctio quam nulla dicta, aut maiores ratione, debitis corrupti modi!"</p>
            </div>

            <div class="bio block">
                <h3 class="title">Bio:</h3>
                <p><?=$shop->bio;?></p>

            </div>

            <div class="sales-award">
                <p class="sales">Sales: <?=$salesCount->sales?></p>
                <?php if($shop->badge != -1){ ?>
                    <div class="award">
                        <img class="icon" src="Views/images/icons/cloudTick.svg" alt="">
                        <p>Best Seller</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>

<div class="product-shop container">
    <h3>Product from Shop</h3>
    <div class="one-product-collection">
        <!-- max seven -->
        <?php foreach($shop_items as $product):?>
        <a href="./product?id=<?=$product->id?>" class="one-more-product link">
            <img class="img" src="uploads/products/<?=$product->image?>" alt="">
            <p class="productEn"><?=$product->name?></p>
            <p class="price">Rs.<?=$product->price?></p>
        </a>
        <?php endforeach;?>

    </div>
</div>

<div class="reviews-collection container">

    <h3 class="heading">Review Gained ( <?=count($reviews);?> )</h3>
    <div class="reviewsContainer">
        <?php foreach($reviews as $review): ?>
           
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
            </div>
            <div class="profile-name">
                <img class="profile-img" src="uploads/<?=$review->reviewer_img?>" alt="">
                <h3 class="name"><?=$review->reviewer_name?></h3>
                <p class="date"><?=$review->review_on?></p>
            </div>
            <p class="reviewPara">
                <?=$review->review_msg?>
            </p>
        </div>
        <?php endforeach;?>

    </div>

    <?php 
    $pagePath = './viewshop';
    include 'Views/paging.php';
    ?>
</div>