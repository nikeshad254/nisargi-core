<div class="first-container container">
    <h3 class="heading">Your Profile: </h3>
    <form action="" method="post" enctype="multipart/form-data" class="profile-update-form">
        <div class="inp-label">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?=$userData['name']?>">
        </div>

        <div class="inp-label">
            <label for="email">email</label>
            <input type="text" name="email" value="<?=$userData['email']?>">
        </div>

        <div class="inp-label">
            <label for="address">address</label>
            <input type="text" name="address" value="<?=$userData['address']?>">
        </div>

        <div class="inp-label">
            <label for="photo">photo</label>
            <input type="file" name="photo">
        </div>

        <div class="inp-label">
            <span>Change Password ?</span>
            <a href="#" class="link changePass">click here</a>
        </div>

        <button class="btn" type="submit">Update Profile</button>

        <img src="uploads/<?=$userData['photo']?>" alt="" class="profileImg">
    </form>
</div>