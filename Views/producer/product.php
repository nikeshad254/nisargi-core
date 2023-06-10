<div class="first-hero container">
        <div class="headers">
            <h3 class="heading">Products In Your Shop</h3>
            <a href="./productCreate" class="Link addNewProduct" id="addNewProduct"><span>+</span><span>Create New</span></a>
        </div>

        <div class="products-container">
            <?php
                $i = 1;

                foreach ($products['Data'] as $product): 
            ?>
            <div class="one-product">
                <img src="uploads/products/<?= $product->image?>" alt="" class="product-img">
                <div class="desc">
                    <p class="name"><?= $product->name?></p>
                    <p class="stock">Stock: <?= $product->stock?> <?= $product->unit?></p>
                    <p class="cost">Rs.<?= $product->price?>/<?= $product->unit?></p>
                </div>
                <div class="buttons">
                    <a href="./productEdit?id=<?= $product->id?>" class="edit btn Link">Edit</a>
                    <a href="./productDelete?id=<?= $product->id?>" class="remove btn Link">Remove</a>
                </div>
            </div>
            <?php endforeach; ?>


        </div>
    </div>