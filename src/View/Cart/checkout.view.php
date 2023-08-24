<?php
echo 'Kasse';
echo '<br>';
echo '<td><a href="/product/login">Logout</a></td>';
echo '<br>';



if(!empty($products)):
    $totalPrice = 0;
    $subTotalPrice = 0;
    ?>
<form action="http://mh-shops.ddev.site/checkoutUpdateCart" method="post">
    <?php
    foreach($products as $product) {
        $productId = $product->getId();
        $subTotal = $product->getPrice() * $_SESSION['cart'][$productId];
        $subTotalPrice = $subTotal;
        ?>
        <input type="text" name="product[<?php echo $product->getId(); ?>][product_name]" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} else {echo $product->getName();}?>" style="width:50px; border:none;"  readonly>
        <input type="text" name="product[<?php echo $product->getId(); ?>][description]" value="<?php if(isset($_POST['description'])) {echo $_POST['description'];} else {echo $product->getDescription();}?>" style="border:none" readonly>
        <input type="text" name="product[<?php echo $product->getId(); ?>][price]" value="<?php if(isset($_POST['price'])) {echo $_POST['price'];} else {echo $product->getPrice();}?>" style="border:none" readonly>
        <input type="number" name="quantity[<?php echo $productId ?>]" min="0" value="<?php echo $_SESSION['cart'][$productId] ?>"><br>
        <td><p> <?php echo $subTotalPrice; ?></p></td>
        <?php
        $totalPrice += $subTotalPrice;
    }
    ?>
    <td><p>Total price: <?php echo $totalPrice; ?></p></td>
    <td><input type="submit" value="update-price"></td>
</form>
<?php endif;?>



<form action="http://mh-shops.ddev.site/paypal" method="Post">
    <input type="image" name="submit_red" alt="Check out with Paypal" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png">
</form>

<form action="http://mh-shops.ddev.site/sofort" method="Post">
    <td><button type="submit">Sofort Überweisung</button></td>
</form>

<form action="http://mh-shops.ddev.site/add-card" method="Post">
    <td><button type="submit">Neue Karte Hinzufügen</button></td>
</form>

<?php
if(!empty($users)): ?>
<?php foreach($users as $user) {?>
    <tr>
        <td><?php echo $user->getName() ?></td>
        <td><?php echo $user->getStreet()?></td>
        <td><?php echo $user->getEmail() ?></td>
    </tr>
<?php } ?>

<?php endif;

