<?php if (!empty($edit) && isset($selectCategories)): ?>
    <form action="http://mh-shops.ddev.site/product/<?php echo $edit->getId(); ?>/edit" method="post">
        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $edit->getName(); ?>">
        <input type="text" name="description" value="<?php echo isset($_POST['description']) ? $_POST['description'] : $edit->getDescription(); ?>">
        <select name="categories[]" multiple>
            <?php foreach ($selectCategories as $selectCategory): ?>
                <?php $select = ($edit->getId() == $selectCategory->getId()) ? 'selected' : ''; ?>
                <option value="<?php echo $selectCategory->getId(); ?>" <?php echo $select; ?>>
                    <?php echo $selectCategory->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Abschicken">
    </form>
<?php endif; ?>
