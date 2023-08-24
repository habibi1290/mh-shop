<?php if (isset($category)): ?>
    <form action="http://mh-shops.ddev.site/category/<?php echo $category->getId()?>/delete" method="Post">
        <input type="hidden" name="id" value="<?php echo $category->getId()?>">
        <input type="submit" value="Löschen">
    </form>
<?php endif;


