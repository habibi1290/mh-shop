<?php
if(!empty($categories)):?>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Parent-Id</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($categories as $category) { ?>
        <tr>
            <td><?php echo $category->getId()?></td>
            <td><?php echo $category->getName()?></td>
            <td>
                <?php if($category->getId() === $category->getParentId()) {

                }
                ?>
                <!--<?php echo $category->getParentId()?>-->
            </td>
            <td><a href="/category/<?php echo $category->getId()?>/delete">Delete</a></td>
            <td><a href="/category/<?php echo $category->getId()?>/edit">Edit</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php endif;?>

<!--if($properties->getId() === $properties->getParentId()) {
$properties->getName();
}-->







