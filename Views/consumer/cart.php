<div class="container first-hero">
        <div class="cart-items">
            <h3>Items in your Cart (2)</h3>
            <div class="one-item">
                <img class="productImg" src="Views/images/apple-demo-product.jpg" alt="">
                <div class="product-seller">
                    <h3>Apple - स्याउ</h3>
                    <p>Seller: Raju's Shop</p>
                </div>
                <div class="qty-rate mob-v">
                    <p>Rate: Rs. 120</p>
                    <p>Qty: 10</p>
                </div>
                <div class="extras mob-v">
                    <p>Delivery</p>
                    <p>Rs. 10</p>
                </div>
                <img id="removeIcon" src="Views/images/icons/minus-circle.svg" alt="">
            </div>

            <div class="one-item">
                <img class="productImg" src="Views/images/apple-demo-product.jpg" alt="">
                <div class="product-seller">
                    <h3>apple - स्याउ</h3>
                    <p>Seller: Raju's Shop</p>
                </div>
                <div class="qty-rate mob-v">
                    <p>Rate: Rs. 120</p>
                    <p>Qty: 10</p>
                </div>
                <div class="extras mob-v">
                    <p>Delivery</p>
                    <p>Rs. 10</p>
                </div>
                <img id="removeIcon" src="Views/images/icons/minus-circle.svg" alt="">
            </div>
        </div>
    </div>
    <div class="address-billing container">
        <div class="default-header">
            <input type="checkbox" id="defaultAddressCheckbox">
            <p>Default Address </p>
        </div>

        <div class="form-billing">
            <div class="delivery-info">
                <div class="headings">
                    <h3>Delivery Information</h3>
                    <button id="setDefault" class="btn">Set Default</button>
                </div>

                <form action="" class="delivery-form" method="post">
                    <div class="label-txt">
                        <label for="full-name">Full Name</label>
                        <input type="text" name="full-name" placeholder="enter your name..">
                    </div>

                    <div class="label-txt">
                        <label for="city">City</label>
                        <input type="text" name="city" placeholder="enter your city..">
                    </div>

                    <div class="label-txt">
                        <label for="street">Street Address</label>
                        <input type="text" name="street" placeholder="enter your street..">
                    </div>

                    <div class="label-txt">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" placeholder="enter your number..">
                    </div>

                    <div class="label-txt">
                        <label for="message">Message:</label>
                        <textarea name="message" id="message" cols="30" rows="10" style="resize:none"
                            placeholder="enter your message.."></textarea>
                    </div>
                </form>

            </div>

            <div class="billing">
                <h3>Billing: </h3>
                <div class="one-shop">
                    <div class="heading">
                        <p>Raju's Shop</p>
                        <p>#1029</p>
                    </div>

                    <table>
                        <thead>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Apple</td>
                                <td>10</td>
                                <td>100</td>
                                <td>1000</td>
                            </tr>
                            <tr class="spanner">
                                <td colspan="3">Delivery</td>
                                <td>10</td>
                            </tr>
                        </tbody>
                        <tfoot class="spanner">
                            <td colspan="3">Total:</td>
                            <td>1020</td>
                        </tfoot>
                    </table>
                </div>

                <div class="one-shop">
                    <div class="heading">
                        <p>Raju's Shop</p>
                        <p>#1029</p>
                    </div>

                    <table>
                        <thead>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Apple</td>
                                <td>10</td>
                                <td>100</td>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <td>Apple</td>
                                <td>10</td>
                                <td>100</td>
                                <td>1000</td>
                            </tr>
                            <tr class="spanner">
                                <td colspan="3">Delivery</td>
                                <td>10</td>
                            </tr>
                        </tbody>
                        <tfoot class="spanner">
                            <td colspan="3">Total:</td>
                            <td>1020</td>
                        </tfoot>
                    </table>
                </div>

                <div class="totalBill">
                    <p>Total Bill:</p>
                    <p>Rs. 1928</p>
                </div>
            </div>

            <div class="btns">
                <img src="Views/images/order-gif.gif" alt="">
                <img src="Views/images/down-gif.gif" alt="">
                <button class="btn">Place Order</button>
            </div>
        </div>
    </div>
