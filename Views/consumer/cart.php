<div class="container first-hero">
    <?php
    if (count($cartItems) < 1) {
        echo '<p>There is No Item In Your Cart</p>';
        exit;
    }
    ?>
    <script src="Views/consumer/js/cart.js"></script>
    <?php
    function findProduct($cartDatas, $productId){
        $foundProduct = null;
        
        foreach ($cartDatas as $cartItem) {
            if ($cartItem['productId'] == $productId) {
                $foundProduct = $cartItem;
                break;
            }
        }
        
        if ($foundProduct) {
            $quantity = $foundProduct['quantity'];
            return $quantity;
        } else {
            return 0;
        }
    }
    ?>
    <div class="cart-items">
        <h3>Items in your Cart ( <?= count($cartItems)?> )</h3>

        <?php foreach($cartItems as $cartItem):
            
            if(isset($_SESSION['shop_data'])){
                if($_SESSION['shop_data']->id == $cartItem->shop_id){
                    echo "<script>removeItem($cartItem->id) 
                            openModal('Items Removed', 'Some Items were removed from your cart.', 0, 3, '')
                        </script>";
                }
            }
        ?>
        <div class="one-item">
            <img class="productImg" src="uploads/products/<?=$cartItem->image;?>" alt="">
            <div class="product-seller">
                <a href="./product?id=<?=$cartItem->id?>" class="link">
                    <h3><?=$cartItem->name;?></h3>
                </a>
                <p>Seller: <?=$cartItem->shop_name;?></p>
            </div>
            <div class="qty-rate mob-v">
                <p>Rate: Rs. <?=$cartItem->price;?></p>
                <p>Qty:
                <?= findProduct($cartDatas, $cartItem->id);?>
                </p>
            </div>
            <div class="extras mob-v">
                <p>Delivery</p>
                <p>Free</p>
            </div>
            <img id="removeIcon" src="Views/images/icons/minus-circle.svg" alt="" onClick="removeItem(<?=$cartItem->id;?>)">
        </div>
        <?php 
        $new_item = array("product_id" => $cartItem->id, "quantity" =>  findProduct($cartDatas, $cartItem->id));
        $order_data["ordered_product"][] = $new_item;

        endforeach;
        ?>
    </div>
</div>
<div class="address-billing container">
    <div class="default-header">
        <input type="checkbox" id="defaultAddressCheckbox" onclick="assignDefaultAddress()">
        <p>Default Address </p>
    </div>

    <div class="form-billing">
        <div class="delivery-info">
            <div class="headings">
                <h3>Delivery Information</h3>
                <button id="setDefault" class="btn" onclick="setDefaultAddress()">Set Default</button>
            </div>

            <form action="" class="delivery-form" method="post">
                <div class="label-txt">
                    <label for="full-name">Full Name</label>
                    <input type="text" name="full-name" placeholder="enter your name.." required>
                </div>

                <div class="label-txt">
                    <label for="city">City</label>
                    <input type="text" name="city" placeholder="enter your city.." required>
                </div>

                <div class="label-txt">
                    <label for="street">Street Address</label>
                    <input type="text" name="street" placeholder="enter your street.." required>
                </div>

                <div class="label-txt">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" placeholder="enter your number.." required>
                </div>

                <div class="label-txt">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" cols="30" rows="10" style="resize:none" placeholder="enter your message.."></textarea>
                </div>

                <button class="btn orderBtn">Place Order</button>
            
            </form>

        </div>
        <?php
        $groupedItems = [];
        foreach ($cartItems as $item) {
            $shopName = $item->shop_name;
            if (!isset($groupedItems[$shopName])) {
                $groupedItems[$shopName] = [];
            }
            $groupedItems[$shopName][] = $item;
        }
        ?>

        <div class="billing">
            <h3>Billing: </h3>
            <?php 
            $billTotal= 0;
            foreach($groupedItems as $pasal):?>
                
            <div class="one-shop">
                <div class="heading">
                    <p><?=$pasal[0]->shop_name;?></p>
                    <!-- <p>####</p> -->
                </div>

                <table>
                    <thead>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        foreach($pasal as $product):
                            $quantity = findProduct($cartDatas, $product->id);
                            $rate = $product->price;
                            $total = $quantity * $rate;
                            $sum += $total;
                            $billTotal += $total;
                        ?>
                        <tr>
                            <td><?=$product->name;?></td>
                            <td><?= $quantity;?></td>
                            <td><?= $rate;?></td>
                            <td><?= $total;?></td>
                        </tr>
                        <?php endforeach;?>
                        <tr class="spanner">
                            <td colspan="3">Delivery</td>
                            <td>Free</td>
                        </tr>
                    </tbody>
                    <tfoot class="spanner">
                        <td colspan="3">Total:</td>
                        <td><?= $sum;?></td>
                    </tfoot>
                </table>
            </div>
            <?php 
            endforeach;?>
            <div class="totalBill">
                <p>Total Bill:</p>
                <p>Rs. <?=$billTotal;?></p>
            </div>
        </div>
    </div>
</div>