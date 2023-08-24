<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikeldetailseite</title>
    <link rel="stylesheet" href="../style/Artikeldetailseite.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>

<body>


<?php require('header.php');?>

<section class="nav">
    <div class="container">
        <div class="row">
            <div class="navbar-menu-email pull-right">
                <a href="#">
                    <img src="https://parts.hatz.com/out/pictures/ddmedia/icon-email-small.svg" class="img-nav" alt="picture">
                </a>
            </div></br></br></br>

            <div class="nav-search pull-right">
                <input type="search" class="search-box" placeholder="Suchen">
                <a href="#" class= "search-bar">
                    <i class="fas fa-search "></i>
                </a>
            </div>

        </div>
    </div>
    </div>
</section>

<section class="section-1-navigation">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="navigation">
                    <div class="col-md-2 col-sm-2 col-xs-4   col-navigation">
                        <a href="#"><span class="span-navigation">lorem Ipsum</span></a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 col-navigation">
                        <a href="#"><span class="span-navigation">lorem Ipsum</span></a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 col-navigation">
                        <a href="#"><span class="span-navigation">lorem Ipsum</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="heading">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 text-center">
                <div class="heading-produktname">
                    <span class="heading-span text-center">Lorem Ipsum Dolor</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="produkt-info">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="hidden-xs col-md-6 hidden-sm col-produkt-info">
                    <img src="../img/digital_products.jpeg" class="img-produkt-info img-responsive" alt="produktimg">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-produkt-info">
                    <div class="col-xs-12">
                        <div class="produkt-info-art text-center">
                            <span class="produkt-info-art-no">Art. Nr:1234567897</span></br>
                            <span class="produkt-name">lorem ipsum</span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="zaehler-box center-block hasnovariant">
                                <span class="input-group-btn">
                                    <buttton class="btn btn-minus js-quantity" type="button" value="minus" data-type="minus" aria-invalid="false">-</buttton>
                                </span>
                            <input id="amountToBasket" type="text" name="am" value="1" autocomplete="off" class="form-control js-amountvalue">
                            <span class="input-group-btn-plus">
                                    <buttton class="btn btn-plus js-quantity" type="button" value="plus" data-type="plus" aria-invalid="false">+</buttton>
                                </span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="produkt-preis text-center">
                            <span class="preis-1">1234 €</span>
                            <span class="preis-2">123456 € </span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="btn-produkt-info text-center">
                            <button type="submit" class="btn-produkt">In den Warenkorb</button>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 hidden-md hidden-lg col-produkt-info">
                        <img src="../img/digital_products.jpeg" class="img-produkt-info img-responsive" alt="produktimg">
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php require('footer.php');?>

<div class="helper-grid">
    <div class="container">
        <div class="row">
            <div class="col-md-1 col-xs-2 helper-grid-col"></div>
            <div class="col-md-1 col-xs-2 helper-grid-col"></div>
            <div class="col-md-1 col-xs-2 helper-grid-col"></div>
            <div class="col-md-1 col-xs-2 helper-grid-col"></div>
            <div class="col-md-1 col-xs-2 helper-grid-col"></div>
            <div class="col-md-1 col-xs-2 helper-grid-col"></div>
            <div class="col-md-1 hidden-xs hidden-sm helper-grid-col"></div>
            <div class="col-md-1 hidden-xs hidden-sm helper-grid-col"></div>
            <div class="col-md-1 hidden-xs hidden-sm helper-grid-col"></div>
            <div class="col-md-1 hidden-xs hidden-sm helper-grid-col"></div>
            <div class="col-md-1 hidden-xs hidden-sm helper-grid-col"></div>
            <div class="col-md-1 hidden-xs hidden-sm helper-grid-col"></div>
        </div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous">
</script>
<script src="../JS/detailseite.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
