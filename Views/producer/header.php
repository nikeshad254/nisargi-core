<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producer</title>
    <link rel="stylesheet" href="Views/producer/css/main.css">

    <?php
    $path = $_SERVER['PATH_INFO'];
    if ($path == '/farmerProduct') {
        echo '<link rel="stylesheet" href="Views/producer/css/producer-product.css">';
    } else if ($path == '/farmerZone') {
        echo '<link rel="stylesheet" href="Views/producer/css/producer-home.css">';
    } else if ($path == '/productCreate' || $path == '/productEdit') {
        echo '<link rel="stylesheet" href="Views/producer/css/producer-create.css">';
    } else if ($path == '/requests') {
        echo '<link rel="stylesheet" href="Views/producer/css/producer-request.css">';
    } else if ($path == '/viewrequest') {
        echo '<link rel="stylesheet" href="Views/producer/css/producer-viewReq.css">';
    } else if ($path == '/shoporders') {
        echo '<link rel="stylesheet" href="Views/producer/css/producerOrder.css">';
    } else if ($path == '/shoporder') {
        echo '<link rel="stylesheet" href="Views/producer/css/producer-oneOrder.css">';
    } else if ($path == '/viewreviews') {
        echo '<link rel="stylesheet" href="Views/producer/css/producer-reviews.css">';
    }
    ?>
</head>

<body>
    <nav class="top-nav">
        <div class="container navigation">
            <div class="left-nav">
                <a href="./farmerZone" class="Link nisargi">Nisargi</a>
            </div>

            <div class="middle-nav">
                <a href="./farmerProduct" class="Link nav-btn">
                    <p>Products</p>
                    <img src="Views/images/icons/shopping-bag.svg" alt="" class="icon">
                </a>
                <a href="./shoporders" class="Link nav-btn">
                    <p>Orders</p>
                    <img src="Views/images/icons/queue-list.svg" alt="" class="icon">
                </a>
                <a href="./viewreviews" class="Link nav-btn">
                    <p>Reviews</p>
                    <img src="Views/images/icons/star.svg" alt="" class="icon">
                </a>
                <a href="./requests" class="Link nav-btn">
                    <p>Requests</p>
                    <img src="Views/images/icons/clipboard.svg" alt="" class="icon">
                </a>

            </div>

            <div class="right-nav">
                <a href="./" class="Link nav-btn">
                    <p>Buyer's Zone</p>
                    <img src="Views/images/icons/cart.svg" alt="" class="icon">
                </a>

                <div class="nav-btn dropdown" id="nav-btn">
                    <p>
                        <?php
                        if (isset($_SESSION['user_data'])) {
                            echo '<img src="uploads/' . $_SESSION["user_data"]->photo . '" alt="" class="profileImg">';
                        } else {
                            echo '<img src="Views/images/icons/user-circle.svg" alt="">';
                        }
                        ?>
                    </p>
                    <img class="downArr" src="Views/images/icons/cat-down.svg" alt="">
                    <ul class="dropdown-ul">
                        <li><a href="./yourprofile">Your Profile</a></li>
                        <li><a href="./yourshop">Shop Profile</a></li>

                        <?php
                        if (isset($_SESSION['user_data'])) {
                            echo '<li><a href="./logout">Logout</a></li>';
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </nav>