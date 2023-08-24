



<?php

if(!empty($orderData) && !empty($orderProducts)):?>

    <?php foreach ($orderData as $product) {?>
        <td><?php echo $product ?><br></td>
    <?php } ?>

    <?php foreach ($orderProducts['products'] as $productId => $product) {?>
        <td><?php echo $product['product_name']?> - <?php echo $product['description']?> <br></td>
    <?php } ?>



<?php endif; ?>

<div i="paypal-payment-button">paypal</div>

<script src="https://www.paypal.com/sdk/js?client-id=AVCn1pNBfgDgfcu4f0kIVIrUV0MgE6HTW9G1QuZpCE_hBucsyB7Qq3hG-xmcKZNpZAi0"></script>
<script>paypal.Buttons().render('#paypal-payment-button')</script>
