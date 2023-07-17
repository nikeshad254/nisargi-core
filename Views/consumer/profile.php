<div class="first-container container">
    <h3 class="heading">Your Profile: </h3>
    <form action="" method="post" enctype="multipart/form-data" class="profile-update-form">
        <div class="inp-label">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?= $userData['name'] ?>">
        </div>

        <div class="inp-label">
            <label for="email">email</label>
            <input type="text" name="email" value="<?= $userData['email'] ?>">
        </div>

        <div class="inp-label">
            <label for="address">address</label>
            <input type="text" name="address" value="<?= $userData['address'] ?>">
        </div>

        <div class="photo-container">
            <?php
                $name = "photo";
                $initial_img = "uploads/".$userData['photo'];
                include('Views/uploadImg.php');
            ?>

        </div>


        <div class="inp-label">
            <span>Change Password ?</span>
            <a href="./changepass" class="link changePass">click here</a>
        </div>

        <button class="btn" type="submit">Update Profile</button>
    </form>
</div>