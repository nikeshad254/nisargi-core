<div class="category-top-hero container">
    <?php
        if(empty($products)){
            echo "<p>No Products Found</p>";
            exit;
        }
    ?>

    <div class="name-label">
        <h3>Fruits</h3>
        <div class="label">
            <a href="#">All</a><span>></span><a href="#"><?=$category?></a>
        </div>
        <small>(<?=count($products);?>) results found</small>
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
        <select>
            <option value="relevance">most popular</option>
            <option value="relevance">price low to high</option>
            <option value="relevance">price high to low</option>
        </select>
    </div>

    <ul class="products-list">
        <?php foreach ($products as $product):?>
        <li class="one-product" id="<?=$product->id;?>">
            <div class="image">
                <img class="img" src="uploads/products/<?=$product->image;?>" alt="">
            </div>
            <div class="content">
                <h4><?=$product->name;?></h4>
                <p><?php
                    echo($product->shop_name);
                    if(isset($_SESSION['shop_data'])  && $product->shop_id  === $_SESSION['shop_data']->id){
                        echo " <b style='color: var(--pink-400);'>(you)</b>";
                    }
                ?></p>
                <p class="price">Rs. <?=$product->price;?></p>
                <div class="stars" id="stars">
                    <img src="Views/images/icons/star.svg" alt="" class="star">
                    <img src="Views/images/icons/star.svg" alt="" class="star">
                    <img src="Views/images/icons/star.svg" alt="" class="star">
                    <img src="Views/images/icons/star.svg" alt="" class="star">
                    <img src="Views/images/icons/star.svg" alt="" class="star">
                    <small>(<?=$product->review_count;?>)</small>
                </div>
                <button id="productBtn<?=$product->id;?>" name="<?=$product->id;?>" class="productBtn">Add to Cart</button>
            </div>
        </li>
        <?php endforeach;?>
    </ul>
</div>

<div class="paging-container">
    <img src="Views/images/icons/arrow.svg" class="left-arrow" alt="">
    <div class="pages">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
    </div>
    <img src="Views/images/icons/arrow.svg" class="right-arrow" alt="">
</div>

<script src="Views/consumer/js/category.js"></script>
