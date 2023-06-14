<div class="first-hero container">
    <h3 class="heading">Create Product</h3>
    <form method="post" enctype="multipart/form-data" class="create-product">
        <div class="lbl-inp">
            <label for="name">Product Name</label>
            <input type="text" name="name" value="<?= htmlentities($product->name) ?>" required>
        </div>

        <div class="lbl-inp">
            <label for="description">Description</label>
            <textarea name="description" cols="30" rows="10" style="resize: none;" required><?= htmlentities($product->description) ?></textarea>
        </div>

        <div class="lbl-inp">
            <label for="image">Image</label>
            <input type="file" name="image" value="<?php echo isset($product) ? 'uploads/products/' . htmlentities($product->image) : ''; ?>">
        </div>


        <div class="lbl-inp">
            <label for="category">Category</label>

            <select name="category" class="category">
                <option value="fruits" <?php echo (htmlentities($product->category) == 'fruits') ? 'selected' : ''; ?>>fruits</option>
                <option value="vegetables" <?php echo (htmlentities($product->category) == 'vegetables') ? 'selected' : ''; ?>>vegetables</option>
                <option value="frozen" <?php echo (htmlentities($product->category) == 'frozen') ? 'selected' : ''; ?>>frozen</option>
                <option value="pickles" <?php echo (htmlentities($product->category) == 'pickles') ? 'selected' : ''; ?>>pickles</option>
                <option value="dairy" <?php echo (htmlentities($product->category) == 'dairy') ? 'selected' : ''; ?>>dairy</option>
                <option value="fertilizer" <?php echo (htmlentities($product->category) == 'fertilizer') ? 'selected' : ''; ?>>fertilizer</option>
            </select>

        </div>

        <div class="lbl-inp">
            <label for="price">Price</label>
            <input type="text" name="price" value="<?= htmlentities($product->price) ?>" required>
        </div>

        <div class="lbl-inp">
            <label for="stock">Stock</label>
            <div class="inps">
                <input type="text" class="stock" value="<?= htmlentities($product->stock) ?>" name="stock">
                <select name="unit">
                    <option value="kg" value="<?= htmlentities($product->name) == 'kg' ? 'selected' : '' ?>">kg</option>
                    <option value="g" value="<?= htmlentities($product->name) == 'g' ? 'selected' : '' ?>">g</option>
                    <option value="pcs" value="<?= htmlentities($product->name) == 'pcs' ? 'selected' : '' ?>">pcs</option>
                    <option value="ltr" value="<?= htmlentities($product->name) == 'ltr' ? 'selected' : '' ?>">ltr</option>
                    <option value="ml" value="<?= htmlentities($product->name) == 'ml' ? 'selected' : '' ?>">ml</option>
                </select>
            </div>
        </div>

        <div class="buttons">
            <a href="./farmerProduct" class="btn Link cancel">Cancel</a>
            <button class="btn post">Update Item</button>
        </div>
    </form>

    <img src="uploads/products/<?php echo htmlentities($product->image); ?>" alt="" style="height: 100px; width:100px; position: absolute; right:29vw; top:20vh;" />
</div>