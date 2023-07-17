<div class="first-hero container" style="padding-top: 1rem;">

    <?php
    $update = false;

    if (isset($shop_data)) {
        $update = true;
    }

    // print_r($shop_data);
    ?>
    <h3 class="heading"><?=$update?'Update':'Register';?> Shop</h3>
    <form method="post" enctype="multipart/form-data" class="shopForm">
        <div class="lbl-inp">
            <label for="name">Shop Name</label>
            <input type="text" name="name" value="<?= $update ? $shop_data->name : '' ?>" required>
        </div>

        <div class="lbl-inp">
            <label for="phone">Phone</label>
            <input type="text" name="phone" value="<?= $update ? $shop_data->phone : '' ?>" required>
        </div>

        <div class="lbl-inp">
            <label for="bio">Bio</label>
            <Textarea name="bio" style="resize: none;" rows="7"><?= $update ? $shop_data->bio : '' ?></Textarea>
        </div>

        <div class="lbl-inp">
            <label for="address">Address</label>
            <input type="text" name="address" value="<?= $update ? $shop_data->address : '' ?>" required>
        </div>

        <div class="photoUploader">
            <?php
            $name = 'image';
            $initial_img = 'uploads/shop/demo_shop.png';
            if ($update) {
                $initial_img = 'uploads/shop/' . $shop_data->image;
                $value = $shop_data->image;
            }
            include 'Views/uploadImg.php';
            ?>
        </div>

        <div class="buttons">
            <button class="btn post"><?=$update?'Update':'Register';?> Shop</button>
        </div>
    </form>
</div>