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
    } else if ($path == '/myorders') {
        echo '<link rel="stylesheet" href="Views/consumer/css/consumerMyOrders.css">';
    } else if ($path == '/billview') {
        echo '<link rel="stylesheet" href="Views/consumer/css/consumerBillView.css">';
    }
    ?>
</head>

<body>
    <nav class="top-nav">
        <div class="main-nav" id="main-nav">
            <div class="left-nav">
                <a href="./" class="link">
                    <h3 class="logo">Nisargi</h3>
                </a>

            </div>

            <div class="middle-nav">
                <form action="./products" method="get" class="search-bar">
                    <input class="search-inp" type="text" placeholder="search products . . . " name="q">
                    <button class="img-btn">
                        <img src="Views/images/icons/search.svg" alt="">
                    </button>
                </form>

                <div class="btns">
                    <div class="cat-btn dropdown" id="cat-btn">
                        <p>Category</p>
                        <img class="downArr" src="Views/images/icons/cat-down.svg" alt="">
                        <ul class="dropdown-ul">
                            <li><a href="./products?category=fruits">Fruits</a></li>
                            <li><a href="./products?category=vegetables">Vegetable</a></li>
                            <li><a href="./products?category=meat">Meat</a></li>
                            <li><a href="./products?category=pickels">Pickel</a></li>
                            <li><a href="./products?category=dairy">Dairy</a></li>
                            <li><a href="./products?category=fertilizer">Fertilizer</a></li>
                        </ul>
                    </div>

                    <a href="./products" class="link nav-btn">
                        <p>Shop Now</p>
                        <img src="Views/images/icons/shopping-bag.svg" alt="">
                    </a>
                </div>

            </div>
            <div class="right-nav">

                <a href="./farmerZone" class="farmer-zone nav-btn link">
                    <p>Your Shop</p>
                    <img src="Views/images/icons/store.svg" alt="">
                </a>

                <div href="login" class="link acc-btn dropdown">
                    <?php
                    if (isset($_SESSION['user_data'])) {
                        echo '<img src="uploads/' . $_SESSION["user_data"]->photo . '" alt="" class="profileImg">';
                        echo '<img class="downArr" src="Views/images/icons/cat-down.svg" alt="">';
                    ?>
                        <ul class="dropdown-ul">
                            <li><a href="#">Profile</a></li>
                            <li><a href="./myorders">My Orders</a></li>
                            <li><a href="logout">Logout</a></li>
                        </ul>
                    <?php
                    } else {
                        echo '<a class="link" href="login">Login</a>';
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



        <img class="three-bars" id="three-bars" src="Views/images/icons/3bars.svg" alt="">
    </nav>

    <script src="Views/consumer/js/main.js"></script>