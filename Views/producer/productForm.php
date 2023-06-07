<div class="first-hero container">
        <h3 class="heading">Create Product</h3>
        <form action="" method="post" class="create-product">
            <div class="lbl-inp">
                <label for="name">Product Name</label>
                <input type="text" name="name">
            </div>

            <div class="lbl-inp">
                <label for="description">Description</label>
                <textarea name="description" cols="30" rows="10" style="resize: none;"></textarea>
            </div>

            <div class="lbl-inp">
                <label for="product_image">Image</label>
                <input type="file" name="product_image">
            </div>

            <div class="lbl-inp">
                <label for="category">Category</label>
                <input type="text" name="category">
            </div>

            <div class="lbl-inp">
                <label for="Price">Price</label>
                <input type="text" name="Price">
            </div>

            <div class="lbl-inp">
                <label for="Stock">Stock</label>
                <div class="inps">
                    <input type="text" class="stock" name="Stock">
                    <select name="unit">
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="ltr">ltr</option>
                        <option value="ml">ml</option>
                    </select>
                </div>
            </div>

            <div class="buttons">
                <a href="#" class="btn Link cancel">Cancel</a>
                <button class="btn post">Post Item</button>
            </div>
        </form>
    </div>