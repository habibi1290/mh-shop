<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>

<?php
if(!empty($products)): ?>
    <table>

        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Preis</th>
            <th>Options</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($products as $product) { ?>
            <tr>
                <td><?php echo $product->getId() ?></td>
                <td><?php echo $product->getName() ?></td>
                <td><?php echo $product->getDescription() ?></td>
                <td><?php echo $product->getPrice()?></td>
                <td><a href="/product/<?php echo $product->getId()?>/delete">Delete</a></td>
                <td><a href="/product/<?php echo $product->getId()?>/edit">Edit</a></td>
                <td><a href="/product/<?php echo $product->getId()?>">detail</a></td>
                <td><a href="/add-to-cart/<?php echo $product->getId()?>">Add to Cart</a></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

<?php endif;?>

</body>
</html>






