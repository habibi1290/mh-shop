<?php

/*if(!empty($edit)):?>
    <form action="http://mh-shops.ddev.site/category/<?php echo $edit->getId()?>/edit" method="Post">
        <input type="text" name="name"
               value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} else {echo $edit->getName();}?>">

        <select name="parent_id">
            <?php foreach ($selectCategories as $selectCategory):
                var_dump($selectCategories);
                    $select = ($edit->getParentId() == $selectCategory->getId()) ? 'selected': '';
                ?>
                <option value="<?=$selectCategory->getId()?>" <?=$select?>> <?=$selectCategory->getName()?> </option>
            <?php endforeach; ?>
        </select>

        <select name="products[]" multiple>
            <?php foreach ($selectProducts as $selectProduct):
                $selectp = ($edit->getId() == $selectProduct->getId()) ? 'selected': '';
                ?>
                <option value="<?=$selectProduct->getId()?>" <?=$selectp?>>
                    <?=$selectProduct->getName()?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Abschicken">
    </form>
<?php endif;?>*/


 if (!empty($edit)): ?>
    <form action="http://mh-shops.ddev.site/category/<?php echo $edit->getId(); ?>/edit" method="post">
        <input type="text" name="name"
               value="<?php if (isset($_POST['name'])) { echo $_POST['name']; } else { echo $edit->getName(); } ?>">

        <select name="parent_id">
            <?php if (isset($selectCategories)): ?>
                <?php foreach ($selectCategories as $selectCategory): ?>
                    <?php $select = ($edit->getParentId() == $selectCategory->getId()) ? 'selected' : ''; ?>
                    <option value="<?=$selectCategory->getId()?>" <?=$select?>><?=$selectCategory->getName()?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <select name="products[]" multiple>
            <?php if (isset($selectProducts)): ?>
                <?php foreach ($selectProducts as $selectProduct): ?>
                    <?php $selectp = ($edit->getId() == $selectProduct->getId()) ? 'selected' : ''; ?>
                    <option value="<?=$selectProduct->getId()?>" <?=$selectp?>>
                        <?=$selectProduct->getName()?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <input type="submit" value="Abschicken">
    </form>
<?php endif; ?>
