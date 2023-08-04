<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nisargi</title>
    <link rel="stylesheet" href="Views/consumer/css/main.css">
    <link rel="stylesheet" href="Views/consumer/css/consumerLogin.css">
</head>

<body>
    <img src="Views/images/bg-pattern-3.png" class="bgImg" alt="">
    <section class="first-hero container">
        <div class="formContainer">
            <div class="descs">
                <h3>Welcome To Nisargi</h3>
                <p class="desc">A common platform for you to buy and sell organic products fresh from farm to your door steps</p>
                <a href="./login" class="btn link">Log In</a>
                <a href="./" class="btn link">Home</a>
            </div>

            <form class="loginForm" method="post" enctype="multipart/form-data">
                <h3>Log In to Nisargi</h3>

                <div class="inputs">
                    <div class="lbl-inp">
                        <label for="name">Name</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="lbl-inp">
                        <label for="address">Address</label>
                        <input type="text" name="address" required>
                    </div>

                    <div class="lbl-inp">
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                    </div>
    
                    <div class="lbl-inp">
                        <label for="password">Password</label>
                        <input type="password" name="password" required>
                    </div>
                </div>

                <button class="btn">Register</button>
            </form>

        </div>

    </section>

    <?php require 'Views/modal.php'?>
</body>

</html>