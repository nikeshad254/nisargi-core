<div class="labels container">
    <!-- <a href="#">All</a><span>></span><a href="#">Fruits</a><span> -->
    <?php
        if(empty($product) || $product==null){
            echo "<h4 style='text-align: center;'>Product Not Found !! </h4>";
            exit;
        }
    ?>
</div>

<div class="container product-view">
    <div class="image-container">
        <img src="uploads/products/<?=$product->image;?>" alt="">
    </div>
    <div class="details-container">
        <h3 class="product"><?=$product->name;?></h3>
        <p class="seller">Seller: <a href="./consumer-producer.html" class="link"><?=$product->shop_name;?></a></p>
        <p class="description"><?=$product->description;?></p>
        <div class="stars-and-award">
            <div class="stars">
                <div class="stars-collection">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                </div>
                <small>(<?=$product->review_count;?>)</small>
            </div>

            <?php if($product->avg_rating >20){?>
            <div class="seller-award">
                <img src="Views/images/icons/cloudTick.svg" alt="" class="icons">
                <p>Best Seller</p>
            </div>
            <?php }?>
        </div>

        <p class="price">Rs. <?=$product->price;?></p>
        <div class="stockQty">
            <div class="qtys">
                <div class="qty">
                    <p onclick="decrement()">-</p>
                    <div class="incrementer" id="incrPlace"></div>
                    <p onclick="increment()">+</p>
                </div>

                <p class="unit"><?=$product->unit;?></p>
            </div>
            <p class="stock">Stock: <?=$product->stock;?> <?=$product->unit;?></p>
        </div>

        <div class="buyCartBtn">
            <button class="btn" id="buyOneProduct">
                Buy Now
            </button>
            <button class="btn" id="addOneCart">
                Add to Cart
            </button>
        </div>

    </div>
</div>


<div class="reviews-section container">
    <div class="avgReview">
        <div class="stars">
            <div class="stars-collection">
                <img src="Views/images/icons/star.svg" alt="" class="icons">
                <img src="Views/images/icons/star.svg" alt="" class="icons">
                <img src="Views/images/icons/star.svg" alt="" class="icons">
                <img src="Views/images/icons/star.svg" alt="" class="icons">
                <img src="Views/images/icons/star.svg" alt="" class="icons">
            </div>
            <small><?=($product->avg_rating == null)?'0':$product->avg_rating;?> : Average Rating</small>
        </div>
    </div>
    <h3>Reviews for this product <span>(<?=$product->review_count;?>)</span></h3>
    <div class="reviewsContainer">
        <div class="one-review">
            <div class="stars-n-more">
                <div class="stars-collection">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                </div>
                <img src="Views/images/icons/3dots.svg" alt="" class="icons">
            </div>
            <div class="profile-name">
                <img class="profile-img" src="Views/images/demo-person.jpg" alt="">
                <h3 class="name">Ram Bahadur Pokhrel</h3>
                <p class="date">2020-20-20</p>
            </div>
            <p class="reviewPara">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique beatae autem laudantium eum qui aperiam alias, tempore consectetur labore fuga quae nemo? Doloremque repellat nemo cumque iusto dolorem impedit facere eaque unde error omnis.
            </p>
        </div>

        <div class="one-review">
            <div class="stars-n-more">
                <div class="stars-collection">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                </div>
                <img src="Views/images/icons/3dots.svg" alt="" class="icons">
            </div>
            <div class="profile-name">
                <img class="profile-img" src="Views/images/demo-person.jpg" alt="">
                <h3 class="name">Ram Bahadur Pokhrel</h3>
                <p class="date">2020-20-20</p>
            </div>
            <p class="reviewPara">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique beatae autem laudantium eum qui aperiam alias, tempore consectetur labore fuga quae nemo? Doloremque repellat nemo cumque iusto dolorem impedit facere eaque unde error omnis.
            </p>
        </div>

        <div class="one-review">
            <div class="stars-n-more">
                <div class="stars-collection">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                </div>
                <img src="Views/images/icons/3dots.svg" alt="" class="icons">
            </div>
            <div class="profile-name">
                <img class="profile-img" src="Views/images/demo-person.jpg" alt="">
                <h3 class="name">Ram Bahadur Pokhrel</h3>
                <p class="date">2020-20-20</p>
            </div>
            <p class="reviewPara">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique beatae autem laudantium eum qui aperiam alias, tempore consectetur labore fuga quae nemo? Doloremque repellat nemo cumque iusto dolorem impedit facere eaque unde error omnis.
            </p>
        </div>

        <div class="one-review">
            <div class="stars-n-more">
                <div class="stars-collection">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                    <img src="Views/images/icons/star.svg" alt="" class="icons">
                </div>
                <img src="Views/images/icons/3dots.svg" alt="" class="icons">
            </div>
            <div class="profile-name">
                <img class="profile-img" src="Views/images/demo-person.jpg" alt="">
                <h3 class="name">Ram Bahadur Pokhrel</h3>
                <p class="date">2020-20-20</p>
            </div>
            <p class="reviewPara">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique beatae autem laudantium eum qui aperiam alias, tempore consectetur labore fuga quae nemo? Doloremque repellat nemo cumque iusto dolorem impedit facere eaque unde error omnis.
            </p>

        </div>
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
</div>

<div class="more-shop container">
    <h3>More from this shop:</h3>
    <div class="one-product-collection">
        <!-- max seven -->
        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="view-more">
            <img src="Views/images/icons/arrow.svg" alt="">
            <p>More</p>
        </div>

    </div>
</div>

<div class="more-shop container">
    <h3>Products you may like:</h3>
    <div class="one-product-collection">
        <!-- max seven -->
        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="one-more-product">
            <img class="img" src="Views/images/mango-demo.png" alt="">
            <p class="productEn">Mango</p>
            <p class="productNp">आप</p>
            <p class="price">Rs.120</p>
        </div>

        <div class="view-more">
            <img src="Views/images/icons/arrow.svg" alt="">
            <p>More</p>
        </div>

    </div>
</div>

<script src="Views/consumer/js/oneProduct.js"></script>