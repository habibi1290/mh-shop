<?php
if (!empty($product)):
    ?>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $product->getName()?></td>
            <td><?php echo $product->getDescription()?></td>
            <td>
                <?php
                if (isset($categoryProduct)) {
                    foreach ($categoryProduct as $category) {
                        echo $category['name'].'<br />';
                    }
                }
                ?>
            </td>
            <td><a href="/add-to-cart/<?php echo $product->getId()?>">Add to Cart</a></td>
        </tr>
        </tbody>
    </table>
<?php endif;



