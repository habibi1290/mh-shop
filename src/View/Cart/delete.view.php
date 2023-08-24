<?php if (isset($products)): ?>
    <form action="http://mh-shops.ddev.site/order/<?php echo $products->getId(); ?>/remove" method="post">
        <input type="hidden" name="id" value="<?php echo $products->getId(); ?>">
        <input type="submit" value="Löschen">
    </form>
<?php endif; ?>
