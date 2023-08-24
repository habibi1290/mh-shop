<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikeluebersichtseite</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

<?php require('header.php');?>

<section class="heading">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <h1 class="heading">Das sind Ihre Ergebnisse.</h1>
            </div>
        </div>
    </div>
</section>

<section class="filter-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 filter-option-part-1">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2-filter-option">
                    <div class="filter-option-cover">
                        <button type="button" class="btn-filter-option-col-2 dropdown-toggle hasTooltip" titel data-toggle="dropdown" data-original-titel="Einsetzbar">
                            Lorem Ipsum
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" >
                            <div class="filter-list">
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                            </div>
                            <button type="submit" class="btn-filter-option btn-secondary center-block">Anwenden</button>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2">
                    <div class="filter-option-cover">
                        <button type="button" class="btn-filter-option-col-2 dropdown-toggle hasTooltip" titel data-toggle="dropdown" data-original-titel="Einsetzbar">
                            Lorem Ipsum
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" >
                            <div class="filter-list">
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                            </div>
                            <button type="submit" class="btn-filter-option btn-secondary center-block">Anwenden</button>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2">
                    <div class="filter-option-cover">
                        <button type="button" class="btn-filter-option-col-2 dropdown-toggle hasTooltip" titel data-toggle="dropdown" data-original-titel="Einsetzbar">
                            Lorem Ipsum
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" >
                            <div class="filter-list">
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                            </div>
                            <button type="submit" class="btn-filter-option btn-secondary center-block">Anwenden</button>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="filter-option-cover">
                        <button type="button" class="btn-filter-option-col-2 dropdown-toggle hasTooltip" titel data-toggle="dropdown" data-original-titel="Einsetzbar">
                            Lorem Ipsum
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" >
                            <div class="filter-list">
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                                <li class="list-filter-option text-center">lorem Ipsum</li>
                            </div>
                            <button type="submit" class="btn-filter-option btn-secondary center-block">Anwenden</button>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 filter-option-part-1">
                <div class="filter-option-cover">
                    <button type="button" class="btn-filter-option-col-4 pull-right dropdown-toggle hasTooltip" titel data-toggle="dropdown" data-original-titel="Einsetzbar">
                        Lorem Ipsum
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu" >
                        <div class="filter-list">
                            <?php
                            $lorem = array('lorem ipsum','lorem ipsum','lorem ipsum','lorem ipsum','lorem ipsum');
                            foreach($lorem as $value) {
                                echo "<li>" . $value . "</li>";
                            }
                            ?>
                        </div>
                        <button type="submit" class="btn-filter-option btn-secondary center-block">Anwenden</button>
                    </ul>
                </div>
            </div>

            <div class="col-md-12 filter-option-part-2">
                <div class="filter-option-collapse">
                    <h4>Lorem Ipsum <i class="fas fa-caret-down filter-option-caret pull-right"></i></h4>
                    <div class="list-filter-option-part-2">
                        <li class="list">lorem ipsum Dolor</li>


                        <li>lorem ipsum Dolor</li>
                        <li>lorem ipsum Dolor</li>
                        <li>lorem ipsum Dolor</li>
                        <li>lorem ipsum Dolor</li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<Section class="section-1">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section col-home">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section-1">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section-1">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section-1">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section-1">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section-1">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section-1">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section-1">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <div class="img-section-1">
                    <img src="../img/foto-1.jpeg" class="img center-block" alt="foto">
                    <span class="span-section-1">lorem Ipsum</span><br><br>
                    <span class="span-section-1">Art.Nr: 123456</span><br>
                    <span class="span-section-1">1234 €</span>
                </div>
            </div>
        </div>
    </div>
</Section>

<section class="section-2-btn">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-2-col">
                <button class="btn-section-2 btn-primary center-block">Weitere anzeigen</button>
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
<script src="../JS/startseite.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
