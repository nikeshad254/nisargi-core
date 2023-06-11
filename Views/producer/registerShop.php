<div class="first-hero container" style="padding-top: 1rem;">
        <h3 class="heading">Register Shop</h3>
        <form method="post" enctype="multipart/form-data" class="create-product">
            <div class="lbl-inp">
                <label for="name">Shop Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="lbl-inp">
                <label for="phone">Phone</label>
                <input type="text" name="phone" required>
            </div>

            <div class="lbl-inp">
                <label for="bio">Bio</label>
                <Textarea name="bio" style="resize: none;" rows="7"></Textarea>
            </div>

            <div class="lbl-inp">
                <label for="address">Address</label>
                <input type="text" name="address" required>
            </div>

            <div class="buttons">
                <a href="./farmerProduct" class="btn Link cancel">Cancel</a>
                <button class="btn post">Post Item</button>
            </div>
        </form>
    </div>
