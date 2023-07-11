<div class="first-container container">
    <h3 class="heading">Leave a review</h3>
    <?php
    // print_r($item);
    // echo '<br>';
    // print_r($review);
    // echo '<br>';
    // print_r($_SESSION);
    // exit;

    if (empty($item)) {
        echo '<br><p> Item not found . . . . . . . . </p><br>';
        echo '<a href="./myorders" class="btn">Go Back</a>';
        exit;
    }
    ?>
</div>


<div class="review-container container">

    <form action="" method="post">
        <p>Click on star for your review</p>
        <div class="stars">
            <input class="star" name="star" value="1" type="checkbox" title="bookmark page">
            <input class="star" name="star" value="2" type="checkbox" title="bookmark page">
            <input class="star" name="star" value="3" type="checkbox" title="bookmark page">
            <input class="star" name="star" value="4" type="checkbox" title="bookmark page">
            <input class="star" name="star" value="5" type="checkbox" title="bookmark page">
        </div>
        <p>Help other by sharing you feedback</p>
        <p>What you like? Did it come in time? Describe your experience with shop/product.</p>

        <textarea name="reviewTxt" class="reviewTxt" placeholder="Enter your message here . . . "><?=(empty($review))?'': $review->message;?></textarea>

        <button type="submit" class="submitBtn btn">Submit Review</button>
        <a href="./myorders" class="btn">Back to your Orders</a>
    </form>

    <div class="review-item">
        <h3 class="heading">You are Reviewing:</h3>

        <div class="items">

            <div class="itemContainer">
                <div class="item">
                    <p class="title"><?= $item['type'] ?> name: </p>
                    <p><?= $item['name']; ?></p>
                </div>

                <div class="item">
                    <p class="title">Bio: </p>
                    <p><?= $item['desc']; ?></p>
                </div>

                <div class="item">
                    <p class="title">Link: </p>
                    <?php
                        if($item['type'] == 'product'){
                            ?>
                            <a href="./viewshop?id=<?= $item['shop_id'] ?>">Visit Shop</a>
                            <?php
                        }else{
                            ?>
                            <a href="./viewshop?id=<?= $item['id'] ?>">Visit Shop</a>
                            <?php
                        }
                    ?>
                </div>
            </div>
            
            <img src="uploads/<?= $item['img_path'] ?>" alt="" class="itemImg">
        </div>
    </div>
</div>

<script>
    let starCount = 0;
    <?php
    if (!empty($review)) {
    ?>
        starCount = <?= $review->star_count; ?>; // Get the star count from PHP
    <?php
    }
    ?>

    function updateStars(count) {
        let star = document.querySelectorAll('.star');

        star.forEach((element, index) => {
            if (index < count) {
                element.classList.add('checked');
                element.checked = true;
            } else {
                element.classList.remove('checked');
                element.checked = false;
            }
        });
    }

    updateStars(starCount);

    let star = document.querySelectorAll('.star');

    star.forEach(element => {
        element.addEventListener('change', () => {
            updateStars(element.value);
        });
    });
</script>