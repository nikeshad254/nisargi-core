<div class="first-hero container">
    <h3 class="heading">Shop Creation</h3>
    <form method="post" enctype="multipart/form-data" class="create-product">
        <div class="lbl-inp">
            <label for="name">Product Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="lbl-inp">
            <label for="description">Description</label>
            <textarea name="description" cols="30" rows="10" style="resize: none;" required></textarea>
        </div>

        <div class="productImgContainer">
            <?php
            $name = "image";
            $required = true;
            include('Views/uploadImg.php');
            ?>
        </div>

        <div class="lbl-inp">
            <label for="category">Category</label>
            <!-- <input type="text" name="category" required> -->
            <select name="category" class="category">
                <option value="fruits">fruits</option>
                <option value="vegetables">vegetables</option>
                <option value="meat">meat</option>
                <option value="pickels">pickels</option>
                <option value="dairy">dairy</option>
                <option value="fertilizer">fertilizer</option>
            </select>
        </div>

        <div class="lbl-inp">
            <label for="price">Price</label>
            <input type="text" name="price" required>
        </div>

        <div class="lbl-inp">
            <label for="stock">Stock</label>
            <div class="inps">
                <input type="text" class="stock" name="stock">
                <select name="unit">
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="pcs">pcs</option>
                    <option value="ltr">ltr</option>
                    <option value="ml">ml</option>
                </select>
            </div>
        </div>

        <div class="buttons">
            <a href="./farmerProduct" class="btn Link cancel">Cancel</a>
            <button class="btn post">Post Item</button>
        </div>
    </form>
</div>