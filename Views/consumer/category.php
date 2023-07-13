<script src="Views/consumer/js/category.js"></script>
<div class="category-top-hero container">
    <?php
    if (empty($products)) {
        echo "<p>No Products Found</p>";
        exit;
    }
    ?>

    <div class="name-label">
        <h3>Fruits</h3>
        <div class="label">
            <a href="#">All</a><span>></span><a href="#"><?= $category ?></a>
        </div>
        <small>( <?= count($nonpagedProducts); ?> ) results found</small>
    </div>
    <div class="all-cats">
        <!-- contain max 9 -->
        <a href="#" class="one-cat">
            <div class="img">
                <img src="Views/images/apple-demo.png" alt="">
            </div>
            <p>Apples</p>
        </a>

        <a href="#" class="one-cat">
            <div class="img">
                <img src="Views/images/banana-demo.png" alt="">
            </div>
            <p>Bananas</p>
        </a>

        <a href="#" class="one-cat">
            <div class="img">
                <img src="Views/images/carrot-demo.png" alt="">
            </div>
            <p>Carrots</p>
        </a>

        <a href="#" class="one-cat">
            <div class="img">
                <img src="Views/images/cucumber-demo.png" alt="">
            </div>
            <p>Cucumbers</p>
        </a>

        <a href="#" class="one-cat">
            <div class="img">
                <img src="Views/images/mango-demo.png" alt="">
            </div>
            <p>Mangos</p>
        </a>

        <a href="#" class="one-cat">
            <div class="img">
                <img src="Views/images/peach-demo.png" alt="">
            </div>
            <p>Peachs</p>
        </a>

        <a href="#" class="one-cat">
            <div class="img">
                <img src="Views/images/pineapple-demo.png" alt="">
            </div>
            <p>Pineapples</p>
        </a>

        <a href="#" class="one-cat">
            <div class="img">
                <img src="Views/images/orange-demo.png" alt="">
            </div>
            <p>Oranges</p>
        </a>

        <a href="#" class="one-cat">
            <div class="img">
                <img src="Views/images/dragonFruit-demo.png" alt="">
            </div>
            <p>Dragon Fruit</p>
        </a>
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
                    <p><?php
                        echo ($product->shop_name);
                        if (isset($_SESSION['shop_data'])  && $product->shop_id  === $_SESSION['shop_data']->id) {
                            echo " <b style='color: var(--pink-400);'>(you)</b>";
                        }
                        ?></p>
                    <p class="price">Rs. <?= $product->price; ?></p>

                    <div class="stars" id="stars">
                    <?php
                    $count = $product->avg_rating;
                    for ($i = 1; $i <= 5; $i++) {
                        if ($count > 0) {
                            echo '<img src="Views/images/icons/star-fill.svg" alt="" class="star">';
                        } else {
                            echo '<img src="Views/images/icons/star.svg" alt="" class="star">';
                        }
                        $count--;
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
