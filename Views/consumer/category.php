<script src="Views/consumer/js/category.js"></script>
<div class="category-top-hero container">
    <?php
    if (empty($products)) {
        echo "<p>No Products Found</p>";
        exit;
    }

    $categorys = [
        "fruits" => [
            "apple" => "Views/images/apple-demo.png",
            "banana" => "Views/images/banana-demo.png",
            "carrot" => "Views/images/carrot-demo.png",
            "cucumber" => "Views/images/cucumber-demo.png",
            "mango" => "Views/images/mango-demo.png",
            "peach" => "Views/images/peach-demo.png",
            "pineapple" => "Views/images/pineapple-demo.png",
            "orange" => "Views/images/orange-demo.png",
            "dragonFruit" => "Views/images/dragonFruit-demo.png",
        ],
        "vegetables" => [
            "carrot" => "Views/images/carrot-demo.png",
            "neuro" => "Views/images/neuro-demo.png",
            "bringal" => "Views/images/bringal-demo.png",
            "spanich" => "Views/images/spanich-demo.png",
            "ghiraula" => "Views/images/ghiraula-demo.png",
        ],
        "dairy" => [
            "milk" => "Views/images/cow milk-demo.png",
            "cheese" => "Views/images/cheese-demo.png",
        ],
        "meat" => [
            "beef" => "Views/images/beef-demo.png",
            "chicken" => "Views/images/chicken-demo.png",
            "lamb" => "Views/images/lamb-demo.png",
        ],
        "pickel" => [
            "khursani" => "Views/images/chilly-demo.png",
            "mula" => "Views/images/mula-demo.png",
        ],
        "fertilizer" => [
            "urea" => "Views/images/inorganic mal.png",
            "chicken" => "Views/images/organic mal.png",
        ],
    ];

    $cat = 'fruits';
    if($category !== ''){
        $cat = isset($categorys[$category])? $category : 'fruits';
    }
    ?>

    <div class="name-label">
        <h3><?= $category;?></h3>
        <div class="label">
            <a href="./products">All</a><span>></span><a href="./products?category=<?=$category;?>"><?= $category ?></a>
        </div>
        <small>( <?= count($nonpagedProducts); ?> ) results found</small>
    </div>
    <div class="all-cats">
        <!-- contain max 9 -->
        <?php foreach($categorys[$cat] as $name => $link):?>
        <a href="./products?q=<?=$name;?>" class="one-cat">
            <div class="img">
                <img src="<?=$link;?>" alt="">
            </div>
            <p><?=$name;?></p>
        </a>
        <?php endforeach;?>
    </div>
</div>

<div class="container products-container">
    <div class="top-portion">
        <h3>Fruits for You</h3>

        <!-- currently not adding low high filters -->
        <!-- <select>
            <option value="relevance">most popular</option>
            <option value="relevance">price low to high</option>
            <option value="relevance">price high to low</option>
        </select> -->
    </div>

    <ul class="products-list">
        <?php foreach ($products as $product) : ?>
            <li class="one-product" id="<?= $product->id; ?>">
                <a href="./product?id=<?=$product->id;?>" class="image">
                    <img class="img" src="uploads/products/<?= $product->image; ?>" alt="">
                </a>
                <div class="content">
                    <h4><?= $product->name; ?></h4>
                    <a href="./viewshop?id=<?=$product->shop_id;?>" class="link"><?php
                        echo ($product->shop_name);
                        if (isset($_SESSION['shop_data'])  && $product->shop_id  === $_SESSION['shop_data']->id) {
                            echo " <b style='color: var(--pink-400);'>(you)</b>";
                        }
                        ?></a>
                    <p class="price">Rs. <?= $product->price; ?></p>

                    <div class="stars" id="stars">
                    <!-- <?php
                    $count = $product->avg_rating;
                    for ($i = 1; $i <= 5; $i++) {
                        if ($count > 0) {
                            echo '<img src="Views/images/icons/ystar-fill.svg" alt="" class="star">';
                        } else {
                            echo '<img src="Views/images/icons/ystar.svg" alt="" class="star">';
                        }
                        $count--;
                    }
                    ?> -->
                    <?php $rating = ($product->avg_rating == null) ? 0 : round($product->avg_rating * 2) / 2;; ?>
                    <?php

                    $count = floor($rating); // Get the integer part of the rating
                    $hasHalfStar = false; // Flag to track if a half star should be displayed

                    if ($rating - $count >= 0.5) {
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
                    
                        <small>(<?= $product->review_count; ?>)</small>
                    </div>
                    <button id="productBtn<?= $product->id; ?>" name="<?= $product->id; ?>" class="productBtn">Add to Cart</button>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php
$pagePath = './products';

include 'Views/paging.php';
?>
