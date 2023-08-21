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
    <img src="Views/images/agriBg.jpg" class="bgImg" alt="">
    <section class="first-hero container">
        <div class="formContainer">
            <div class="descs">
                <h3>Welcome To Nisargi</h3>
                <p class="desc">A common platform for you to buy and sell organic products fresh from farm to your door steps</p>
                <a href="./register" class="btn">Register</a>
                <a href="./" class="btn">Home</a>
            </div>

            <form class="loginForm" method="post">
                <h3>Log In to Nisargi</h3>

                <div class="inputs">
                    <div class="lbl-inp">
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                    </div>

                    <div class="lbl-inp">
                        <label for="password">Password</label>
                        <input type="password" name="password" required>
                    </div>
                </div>

                <button class="btn">Log In</button>
            </form>

        </div>

    </section>
    <?php require "Views/modal.php"; ?>
</body>

</html>