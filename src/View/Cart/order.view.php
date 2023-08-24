<?php

if(!empty($products)):?>

    <form action="http://mh-shops.ddev.site/order" method="Post">
            <?php foreach($products as $product): ?>
                <input type="text" name="product[<?php echo $product->getId(); ?>][product_name]" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} else {echo $product->getName();}?>" style="width:50px; border:none;"  readonly>
                <input type="text" name="product[<?php echo $product->getId(); ?>][description]" value="<?php if(isset($_POST['description'])) {echo $_POST['description'];} else {echo $product->getDescription();}?>" style="width:150px; border:none;" readonly><br>
            <?php endforeach;?>

            <input type="text" name="name" placeholder="Vorname" required>
            <input type="text" name="lastname" placeholder="Nachname" required>
            <input type="text" name="street-house-number" placeholder="Straße und Hausnummer" style="width:150px" required>
            <input type="number" name="postal-code" placeholder="PLZ" required>
            <input type="text" name="telefonnumber" placeholder="Telefonnummer (erforderlich)" style="width:200px" required>
            <input type="email"  name="email" placeholder="Email" required>
            <input type="submit" value="Fertig">
    </form>
<?php endif;?>
