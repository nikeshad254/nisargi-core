<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nisargi</title>
    <link rel="stylesheet" href="Views/consumer/css/main.css">
    <?php
    $path = $_SERVER['PATH_INFO'];
    if ($path == '/') {
        echo '<link rel="stylesheet" href="Views/consumer/css/consumerHome.css">';
    } else if ($path == '/registerShop') {
        echo '<link rel="stylesheet" href="Views/producer/css/producer-create.css">';
    } else if ($path == '/products') {
        echo '<link rel="stylesheet" href="Views/consumer/css/consumerCategory.css">';
    } else if ($path == '/yourcart') {
        echo '<link rel="stylesheet" href="Views/consumer/css/consumerCart.css">';
    } else if ($path == '/product') {
        echo '<link rel="stylesheet" href="Views/consumer/css/consumerProduct.css">';
    }else if ($path == '/myorders') {
        echo '<link rel="stylesheet" href="Views/consumer/css/consumerMyOrders.css">';
    }
    ?>
</head>

<body>
    <nav class="top-nav">
        <div class="main-nav" id="main-nav">
            <div class="left-nav">
                <a href="./" class="link">
                    <h3>Nisargi</h3>
                </a>
            </div>

            <div class="middle-nav">

                <div class="cat-btn" id="cat-btn">
                    <p>Category</p>
                    <img src="Views/images/icons/cat-down.svg" alt="">
                </div>

                <a href="./products" class="link nav-btn">
                    <p>Shop Now</p>
                </a>

                
                <a href="./myorders" class="link nav-btn">
                    <p>Your Orders</p>
                </a>
                
                <a href="./farmerZone" class="link nav-btn">
                    <p>Farmer's Zone</p>
                </a>
            </div>
            <div class="right-nav">

                <div class="search-bar">
                    <input type="text" placeholder="search here ... ">
                    <img src="Views/images/icons/search.svg" alt="">
                </div>

                <div href="login" class="link nav-btn">

                    <?php
                    if (isset($_SESSION['user_data'])) {
                        echo '<img src="uploads/' . $_SESSION["user_data"]->photo . '" alt="" class="profileImg">';
                        echo '<a  class="btn btn-success" href="logout">Logout</a>';
                    } else {
                        echo '<img src="Views/images/icons/user-circle.svg" alt="">';
                        echo '<a  class="btn btn-success" href="login">Login</a>';
                    }
                    ?>
                </div>

                <a href="./yourcart" class="nav-btn cart-btn link">
                    <img src="Views/images/icons/cart.svg" alt="">
                    <p>Cart</p>
                    <small id="cart-num">X</small>
                </a>
            </div>
        </div>

        <div id="categories" class="categories-display">
            <div class="container">
                <div class="first-group cat-group">
                    <p><a href="#" class="link">Fruits</a></p>
                    <a href="#" class="link">Apple</a>
                    <a href="#" class="link">Mango</a>
                    <a href="#" class="link">Banana</a>
                    <a href="#" class="link">Cucumber</a>
                    <a href="#" class="link">more...</a>
                </div>
                <div class="second-group cat-group">
                    <p><a href="#" class="link">Fruits</a></p>
                    <a href="#" class="link">Apple</a>
                    <a href="#" class="link">Mango</a>
                    <a href="#" class="link">Banana</a>
                    <a href="#" class="link">Cucumber</a>
                    <a href="#" class="link">more...</a>
                </div>
                <div class="third-group cat-group">
                    <p><a href="#" class="link">Fruits</a></p>
                    <a href="#" class="link">Apple</a>
                    <a href="#" class="link">Mango</a>
                    <a href="#" class="link">Banana</a>
                    <a href="#" class="link">Cucumber</a>
                    <a href="#" class="link">more...</a>
                </div>
            </div>
        </div>



        <img class="three-bars" id="three-bars" src="Views/images/icons/3bars.svg" alt="">
    </nav>

    <script src="Views/consumer/js/main.js"></script>