<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/CheckOut.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

<?php require('header.php');?>

<section class="nav">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="btn-group service-menu showLogin overLaybox pull-right">
                    <ul class="dropdown-menu dropdown-menu-right pull-right" role="menu">
                        <li class="headline">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        Mein Konto
                                        <div class="closeit">
                                            <a href="#"><i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <li class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <form class="form" id="login-mail" name="login" >
                                        <div class="form-mail col-sm-6">
                                            <div class="form-email pull-right" id="login-email1" >
                                                <input type="email" class="login-email" placeholder ="Email-Adresse">
                                            </div>
                                        </div>

                                        <div class="form-password col-sm-6">
                                            <div class="form-pwd pull-left" id="login-pwd" name="login">
                                                <input type="password" class="login-password" placeholder="Passwort">
                                            </div></br></br>
                                            <div class="col-md-3 col-sm-6 col-xs-12 col-pwd-checkbox">
                                                <div class="pwd-checkbox">
                                                    <input type="checkbox" class="checkbox" name="lg-name" id="remember">
                                                    <label for="remember" class="pwd-label">Passwort merken</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12 col-pwd-vergessen pull-right">
                                                <div class="pwd-vergessen">
                                                    <a href="#" class="pwd-link">Passwort vergessen</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 register">
                                            <button class="btn-register pullrightdesktop">Registrieren</button>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 anmelden">
                                            <button class="btn-anmelden">Anmelden</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                </div>
                </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</section>


<section class="number">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="number-1">
                    <div class="num1 center-block">
                        <span class="num-1">1</span>
                    </div>
                    <div class="text1 text-center">Bestellangaben</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="num2 center-block">
                    <span class="num-2">2</span>
                </div>
                <div class="text2 text-center">Versand & Zahlart</div>
            </div>

            <div class="col-md-4">
                <div class="num3 center-block">
                    <span class="num-3">3</span>
                </div>
                <div class="text3 text-center">Bestellung Prüfen</div>
            </div>
        </div>
    </div>
</section>


<section class="heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="anmeldung">
                    <h1>Anmeldung</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, maiores?
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="checkout-box">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="box-1">
                    <div class="link-checkout-box text-center">
                        <a href="#" class="user-check"><i class="far fa-user user"></i></a>
                    </div>
                    <div class="box-titel">
                        <h4 class="checkout-box-titel">Bereits Kunde</h4>
                    </div>
                    <div class="checkinfo">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box-2">
                    <div class="link-checkout-box text-center">
                        <a href="#" class="user-check"><i class="fas fa-user-plus user"></i></a>
                    </div>
                    <div class="box-titel">
                        <h4 class="checkout-box-titel">Neues Konto</h4>
                    </div>
                    <div class="checkinfo">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box-3">
                    <div class="link-checkout-box text-center">
                        <a href="#" class="user-check"><i class="fas fa-id-card-alt user"></i></a>
                    </div>
                    <div class="box-titel">
                        <h4 class="checkout-box-titel">Gastbestellung</h4>
                    </div>
                    <div class="checkinfo">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout-login">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="header-checkout-login">
                    <h4 class="header-h4">Kundenkonto anlegen</h4>
                </div>
                <div class="txt-para">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                </div>

                <div class="checkout-login-form">
                    <form class="form">
                        <input type="email" class="email-checkout-form" placeholder="Email-Adresse"></br></br>
                        <input type="pwd" class="pwd-checkout-form" placeholder="Passwort">
                    </form>
                </div>

                <div class="checkbox-login">
                    <input type="checkbox" class="checkbox-login-input" id="checkbox-login-label">
                    <label for="checkbox-login-label" class="label-checkbox-login">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        A ab accusantium assumenda consectetur error provident quaerat repudiandae sequi sint voluptatem.
                    </label>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout-userdata">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-data">
                    <h2 class="checkout-userdata-h2">Rechnungs & Lieferadressen</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="userdata">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Rechnungsadresse</h3>
                <p class="userdata-para">
                    Lorem ipsum dolor sit amet, consectetur adipisicing.
                </p>
                <input type="text" class="vorname userdata-input" placeholder="Vorname" ></br>
                <input type="text" class="nachname userdata-input" placeholder="Nachname"></br>
                <input type="text" class="Firma userdata-input" placeholder="Firma"></br>
                <input type="text" class="info userdata-input" placeholder="Zus.Info"></br>
                <input type="text" class="strasse userdata-input-1" placeholder="Straße">
                <input type="text" class="nummer userdata-input-1" placeholder="Nr"></br>
                <input type="text" class="plz userdata-input-1" placeholder="PlZ">
                <input type="text" class="ort userdata-input-1" placeholder="Ort"></br>
                <input type="text" class="land userdata-input" placeholder="Land"></br>
                <input type="text" class="telefon userdata-input" placeholder="Telefon"></br>
                <input type="text" class="telefax userdata-input" placeholder="Telefax"></br>
                <input type="text" class="mobiltelefon userdata-input" placeholder="Mobiltelefon"></br>
                <input type="text" class="ust userdata-input" placeholder="USt-ID"></br>
                <input type="text" class="Geburtsdatum userdata-input" placeholder="Geburtsdatum">
            </div>

            <div class="col-md-6">
                <h3>Abweichende Lieferadresse verwenden?</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis nemo porro repellendus vero.
                </p>
                <input type="checkbox" class="input-userdata" id="userdata-label">
                <label for="userdata-label" class="userdata-label">Lorem ipsum dolor.</label>
            </div>
        </div>
    </div>
</section>

<Section class="login-buttons">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-6">
                <button type="submit" class="btn-login-1">Zurück</button>
            </div>

            <div class="col-md-6 col-xs-6">
                <button type="submit" class="btn-login-2">Weiter</button>
            </div>
        </div>
    </div>
</Section>

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
<script src="../back-up/JS/script.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
