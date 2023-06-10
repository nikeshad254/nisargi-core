<div class="first-hero container">
        <h3 class="heading">Create Product</h3>
        <form method="post" enctype="multipart/form-data" class="create-product">
            <div class="lbl-inp">
                <label for="name">Product Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="lbl-inp">
                <label for="description">Description</label>
                <textarea name="description" cols="30" rows="10" style="resize: none;" required></textarea>
            </div>

            <div class="lbl-inp">
                <label for="image">Image</label>
                <input type="file" name="image" required>
            </div>

            <div class="lbl-inp">
                <label for="category">Category</label>
                <input type="text" name="category" required>
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
                        <option value="g" >g</option>
                        <option value="ltr" >ltr</option>
                        <option value="ml" >ml</option>
                    </select>
                </div>
            </div>

            <div class="buttons">
                <a href="./farmerProduct" class="btn Link cancel">Cancel</a>
                <button class="btn post">Post Item</button>
            </div>
        </form>
    </div>
