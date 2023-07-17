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

            <label class="label">
                <img class="inputImg" src="uploads/<?= $userData['photo'] ?>">
                <input type="file" name="photo" id="file" required />
                <span>click to replace</span>
            </label>
        </div>


        <div class="inp-label">
            <span>Change Password ?</span>
            <a href="./changepass" class="link changePass">click here</a>
        </div>

        <button class="btn" type="submit">Update Profile</button>
    </form>
</div>

<script>
    let fileBtn = document.querySelector('#file');
    let inputImg = document.querySelector('.inputImg');
    fileBtn.addEventListener('change', (e) => {
        let file = e.target.files[0];
        console.log(e.target.files);
        console.log(URL.createObjectURL(file));
        console.log(file.name);
        inputImg.src = URL.createObjectURL(file);
    })
</script>