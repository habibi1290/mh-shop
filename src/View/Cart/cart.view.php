
<?php
if(!empty($products)):
    $totalPrice = 0;
    $subTotalPrice = 0;
    ?>
    <form method="post" action="http://mh-shops.ddev.site/update-cart">
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>SubTotal</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($products as $product) {
                $productId = $product->getId();
                $quantity = isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId] : 0;
                $subTotal = $product->getPrice() * $quantity;
                $subTotalPrice = $subTotal;
                ?>
                <tr>
                    <td><?php echo $product->getName()?></td>
                    <td><?php echo $product->getDescription()?></td>
                    <td><?php echo $product->getPrice()?></td>
                    <td><p> <?php echo $subTotalPrice; ?></p></td>
                    <td><a href="/order/<?php echo $productId?>/remove">Entfernen</a></td>
                    <td>
                        <input type="number" name="quantity[<?php echo $productId ?>]" min="0" value="<?php echo $quantity ?>" placeholder="Stück">
                    </td>
                </tr>
                <?php
                $totalPrice += $subTotalPrice;
            }?>

            <td><a href="/product/login">Zur Kasse</a></td>

            <td><input type="submit" value="update-price"></td>
            <td></td>
            <td><p>Total price: <?php echo $totalPrice; ?></p></td>
            </tbody>
        </table>
    </form>
<?php endif;?>
