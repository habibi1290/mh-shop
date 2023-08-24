<?php if (isset($product)): ?>
<form action="http://mh-shops.ddev.site/product/<?php echo $product->getId()?>/delete" method="Post">
    <input type="hidden" name="id" value="<?php echo $product->getId()?>">
    <input type="submit" value="Löschen">
</form>
<?php endif;


