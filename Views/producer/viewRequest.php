<div class="first-hero container">
        <?php
            if(count($orders)<1){
                echo "record not found";
                exit;
            }
            $request = $orders[0];
        ?>
        <a href="./requests" class="btn Link backBtn">Go Back</a>

        <h3 class="heading">Request of <?=$request->delivery_name;?></h3>

        <div class="delivery-billing">
            <div class="delivery">
                <h3>Delivery Info</h3>

                <p>
                    <span>Name: </span>
                    <span><?=$request->delivery_name;?></span>
                </p>

                <p>
                    <span>Address: </span>
                    <span><?=$request->city?> , <?= $request->street;?></span>
                </p>

                <p>
                    <span>Phone: </span>
                    <span><?=$request->mobile;?></span>
                </p>

                <p>
                    <span>Message: </span>
                    <span class="msg"><?=$request->delivery_message;?></span>
                </p>

                <a href="./handleRequest?id=<?=$request->order_id;?>&approve=false" class="Link button"> Cancel Request </a>
            </div>
            <div class="billing">
                <h3 class="bill-head">
                    <span>#<?=$request->order_id;?></span>
                    <p>Billing</p>
                    <p>Date: <?=$request->date;?></p>
                </h3>

                <table>
                    <thead>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </thead>
                    <tbody>
                        <?php 
                            $sum = 0;
                            foreach($request->products as $product):
                            $sum += $product['price'] * $product['quantity'];
                        ?>
                        <tr>
                            <td><?=$product['product_name'];?></td>
                            <td><?=$product['quantity'];?></td>
                            <td><?=$product['price'];?></td>
                            <td><?=$product['price'] * $product['quantity'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="3">Total:</td>
                            <td>Rs. <?=$sum?></td>
                        </tr>
                    </tfoot>
                </table>

                <a href="./handleRequest?id=<?=$request->order_id;?>&approve=true" class="Link button"> Approve Request </a>
            </div>

        </div>
    </div>