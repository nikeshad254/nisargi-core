<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producer Home</title>
    <link rel="stylesheet" href="Views/producer/css/main.css">

    <?php 
        $path = $_SERVER['PATH_INFO'];
        if( $path == '/farmerProduct'){
            echo '<link rel="stylesheet" href="Views/producer/css/producer-product.css">';
        }else if($path == '/farmerZone'){
            echo '<link rel="stylesheet" href="Views/producer/css/producer-home.css">';
        }else if($path == '/productCreate'){
            echo '<link rel="stylesheet" href="Views/producer/css/producer-create.css">';
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
                <a href="#" class="Link nav-btn">
                    <p>Orders</p>
                    <img src="Views/images/icons/queue-list.svg" alt="" class="icon">
                </a>
                <a href="#" class="Link nav-btn">
                    <p>Reviews</p>
                    <img src="Views/images/icons/star.svg" alt="" class="icon">
                </a>
                <a href="#" class="Link nav-btn">
                    <p>Requests</p>
                    <img src="Views/images/icons/clipboard.svg" alt="" class="icon">
                </a>

            </div>

            <div class="right-nav">
                <a href="./" class="Link nav-btn">
                    <p>Buyer's Zone</p>
                    <img src="Views/images/icons/cart.svg" alt="" class="icon">
                </a>
                <a href="#" class="Link nav-btn">
                <?php
                    if(isset($_SESSION['user_data'])){
                        echo '<img src="uploads/'.$_SESSION["user_data"]->photo.'" alt="" class="profileImg">';
                        echo '<a  class="btn btn-success" href="logout">Logout</a>';
                    }else{
                        echo '<img src="Views/images/icons/user-circle.svg" alt="">';
                        echo '<a  class="btn btn-success" href="login">Login</a>';
                    }
                    ?>
                </a>
            </div>
        </div>
    </nav>