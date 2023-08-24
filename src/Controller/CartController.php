<?php
namespace Mh\Shop\Controller;

use Mh\Shop\Repository\CartRepository;
use Mh\Shop\Repository\ProductRepository;
use Mh\Shop\Utility\View;
use MrStronge\SimpleRouter\Attributes\Get;
use MrStronge\SimpleRouter\Attributes\Post;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentExecution;
use Mh\package1\Controller\Controller;
use Whoops\Run;
use Whoops\Run\Handler\PrettyPageHandler;

class CartController extends View
{
    protected CartRepository $cartRepository;
    protected ProductRepository $productRepository;
    /*protected Payer $payer;
    protected Item $item;
    protected RedirectUrls $urls;
    protected ItemList $itemList;
    protected Payment $payment;
    protected Transaction $transaction;
    protected ApiContext $context;*/
    protected PHPMailer $mailer;
    protected Controller $controllerpackage1;
    protected Run $Whoops;
    public function __construct()
    {
        $this->cartRepository = new CartRepository();
        $this->productRepository = new ProductRepository();
        $this->mailer = new PHPMailer(true);
        $this->controllerpackage1 = new Controller();
        $this->Whoops = new Run();
        $this->whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $this->whoops->register();
        /* $this->payer = new Payer();
         $this->item = new Item();
         $this->itemList = new ItemList();
         $this->urls = new RedirectUrls();
         $this->payment = new Payment();
         $this->transaction = new Transaction();*/

        if (!isset ($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Get('/add-to-cart/{id}')]
    public function addToCard(array $args): void
    {
        $productId = $args['id'];
        $this->cartRepository->getIdAndSaveInSession($productId);
        header('Location: http://' . $_SERVER["SERVER_NAME"] . '/cart');
    }

    #[Get('/cart')]
    public function show(): void
    {
        $products = array();
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $this->productRepository->get($key);
            $products[] = $product;
        }
        $this->render('Cart/cart', ['products' => $products]);
    }

    #[Get('/update-cart')]
    public function updateCart(): void
    {
        $this->render('Cart/updateCart',[]);
    }

    #[Post('/update-cart')]
    public function updateCartPost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST['quantity'] as $productId => $quantity) {
                $_SESSION['cart'][$productId] = $quantity;
            }
            header('Location: http://' . $_SERVER["SERVER_NAME"] . '/cart');
            exit;
        }
    }

    #[Get('/checkoutUpdateCart')]
    public function updateCheckout(): void
    {
        $this->render('Cart/checkoutUpdateCart',[]);
    }

    #[Post('/checkoutUpdateCart')]
    public function updateCheckoutPost(): void
    {
        $quantities = $_POST['quantity'];
        foreach($quantities as $productId => $quantity) {
            $_SESSION['cart'][$productId] = $quantity;
        }
        header('Location: http://' . $_SERVER["SERVER_NAME"] . '/checkout');
        exit;
    }

    #[Get('/signin')]
    public function register(): void
    {
        $this->render('Cart/signin', []);
    }

    #[Post('/signin')]
    public function sendRegisterDataToDb(): void
    {
        if (!empty($_POST)) {
            $name = $_POST['name'];
            $lastName = $_POST['lastname'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $street = $_POST['street'];
            $houseNumber = $_POST['housenumber'];
            $postalcode = $_POST['postalcode'];
            $telefonNumber = $_POST['telefonnumber'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo 'Bitte geben sie eine gültige Email ein';
                $this->render('Cart/signin', []);
            }

            if (!preg_match('/^[0-9]{5}$/', $postalcode)) {
                echo 'Bitte geben sie eine gültige PLZ ein';
                $this->render('Cart/signin', []);
            }

            if (strlen($telefonNumber) != 11) {
                echo 'Bitte geben sie eine gültige Telefonnummer ein';
                $this->render('Cart/signin', []);
            }

            if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password)) {
                echo "
                Password nicht gültig<br>
                Mindestens 8 Zeichen Länge.<br>
                Mindestens ein Großbuchstabe des englischen Alphabets.<br>
                Mindestens ein Kleinbuchstabe des englischen Alphabets.<br>
                Mindestens eine Ziffer.<br>
                Mindestens ein Sonderzeichen (das kann jedes nicht alphanumerische Zeichen sein).
                ";
                $this->render('Cart/signin', []);
            }

            if (!empty($name) && !empty($lastName) && !empty($email) && !empty($password) && !empty($street) && !empty($houseNumber) && !empty($postalcode) && !empty($telefonNumber)) {
                if (!$this->cartRepository->checkIfEmailExist($email)) {
                    $this->cartRepository->insertToDb($name, $lastName, $email, $password, $street, (int)$houseNumber, $postalcode, $telefonNumber);
                    echo 'Konto erfolgreich erstellt';
                    $this->render('Login/login');
                } else {
                    echo "E-mail Adresse bereits vorhanden";
                    $this->render('Cart/signin', []);
                }
            }
        }
    }

    /**
     * @param array<mixed> $args
     * @return void
     */
    #[Get('/order/{id}/remove')]
    public function removeId(array $args): void
    {
        $productId = $args['id'];
        unset($_SESSION['cart'][$productId]);
        header('location: /cart');
        exit;
    }

    #[Get('/order')]
    public function getOrder(): void
    {
        $products = array();
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $this->productRepository->get($key);
            $products[] = $product;
        }
        $this->render('Cart/order', ['products' => $products]);
    }

    #[Post('/order')]
    public function postOrder(): void
    {
        if (!empty($_POST)) {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $lastName = $_POST['lastname'];
            $streetHouseNumber = $_POST['street-house-number'];
            $postalCode = $_POST['postal-code'];
            $telefonNumber = $_POST['telefonnumber'];
            $products = $_POST['product'];

            $orderData = [
                'name' => $name,
                'lastName' => $lastName,
                'streetHouseNumber' => $streetHouseNumber,
                'postalCode' => $postalCode,
                'telefonNumber' => $telefonNumber,
            ];

            $orderProducts = [
                'products' => $products,
            ];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo 'Bitte geben sie eine gültige Email ein';
                $this->render('Cart/order', []);
            }

            if (!preg_match('/^[0-9]{5}$/', $postalCode)) {
                echo 'Bitte geben sie eine gültige PLZ ein';
                $this->render('Cart/order', []);
            }

            if (strlen($telefonNumber) != 11) {
                echo 'Bitte geben sie eine gültige Telefonnummer ein';
                $this->render('Cart/order', []);
            }

            $text = <<<body
             Name: $name
             Nachname: $lastName
             Straße und Hausnummer: $streetHouseNumber
             PLZ: $postalCode
             Telefonnummer: $telefonNumber 
             
            body;

            foreach ($products as $productId => $product) {
                $productObj = $this->productRepository->get((int)$productId);
                $text .= "\n Produkt: " . $productObj->getName() . "\n Beschreibung: " . $productObj->getDescription() . "\n Stückzahl:";  /*.$product['quantity'] . "\n"*/
            }

            $email = (new Email())
                ->from('support@example.com')
                ->to($email)
                ->subject('Bestell-Bestätigung')
                ->text($text);
            $dsn = 'smtp://localhost:1025';
            $transport = Transport::fromDsn($dsn);
            $mailer = new Mailer($transport);
            $mailer->send($email);
            $this->render('Cart/gastCheckout', ['orderData' => $orderData, 'orderProducts' => $orderProducts]);
        }
    }

    #[Get('/checkout')]
    public function checkout(): void
    {
        $products = array();
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $this->productRepository->get($key);
            $products[] = $product;
        }
        $users = $this->cartRepository->getUsers();
        $this->render('Cart/checkout', ['products' => $products, 'users' => $users]);
    }

    #[Get('/gastCheckout')]
    public function gastCheckout(): void
    {
        $this->render('Cart/gastCheckout', []);
    }

    #[Get('/paypal')]
    public function paypalPayment(): void
    {
        $this->render('Cart/paypal', []);
    }

    #[Post('/paypal')]
    public function paypalPaymentPost(): void
    {
        $subTotal = 0;
        $items = [];
        $details = new Details();

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $products = array();
        foreach ($_SESSION['cart'] as $key => $value)
        {
            $product = $this->productRepository->get($key);
            $products[] = $product;
        }

        foreach ($products as $product)
        {
            $items[] = $item = new Item();
            $item->setName($product->getName())
                ->setCurrency('EUR')
                ->setQuantity($_SESSION['cart'][$product->getId()])
                ->setPrice($product->getPrice());
        }

        $itemList = new ItemList();
        $itemList->setItems($items);

        foreach ($products as $product)
        {
            $subTotal += $product->getPrice() * $_SESSION['cart'][$product->getId()];
            $details->setShipping(40)
            ->setTax(0)
            ->setSubtotal($subTotal);
        }

        $tax = 0;
        $shipping = 40;
        $total = $subTotal + $tax + $shipping;
        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setDetails($details)
            ->setTotal($total);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("paypment desscription")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl('http://mh-shops.ddev.site/payment')
            ->setCancelUrl('http://mh-shops.ddev.site/checkout');

        $payment1 = new Payment();
        $payment1->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                'AUzpKqjBDVtp0upPEh9eJExQttlWjEYw1maN22K4ChAtbHHltzvT5woColo1tmA8eAtlEMjVSRGuxg5n',
                'EGpKikSOOVCG__FHFYPpX7QulxE8kdFeuTdhfSEAxGz-zUXlTHgu7XX1mO4ZrMR28f9R_Tz8mOYTSHUh'
            )
        );
        $payment1->create($apiContext);
        $approvalUrl = $payment1->getApprovalLink();
        header("Location: " . $approvalUrl);
    }

    #[Get('/payment')]
    public function executePayment(): void
    {
        $subTotal  = 0;
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                'AUzpKqjBDVtp0upPEh9eJExQttlWjEYw1maN22K4ChAtbHHltzvT5woColo1tmA8eAtlEMjVSRGuxg5n',
                'EGpKikSOOVCG__FHFYPpX7QulxE8kdFeuTdhfSEAxGz-zUXlTHgu7XX1mO4ZrMR28f9R_Tz8mOYTSHUh'
            )
        );

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $products = array();
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $this->productRepository->get($key);
            $products[] = $product;
        }
        foreach ($products as $product)
        {
            $subTotal += $product->getPrice() * $_SESSION['cart'][$product->getId()];
            $details->setShipping(40)
                    ->setTax(0)
                    ->setSubtotal($subTotal);
        }

        $tax = 0;
        $shipping = 40;
        $total = $subTotal + $tax + $shipping;
        $amount->setCurrency('EUR');
        $amount->setTotal($total);
        $amount->setDetails($details);

        $transaction->setAmount($amount);
        $execution->addTransaction($transaction);

        $result = $payment->execute($execution, $apiContext);
        $result = $result->toJSON();
        $result = json_decode($result);

        if ($result->state === 'approved')
        {
            $products = array();
            foreach ($_SESSION['cart'] as $key => $value) {
                $product = $this->productRepository->get($key);
                $products[] = $product;
            }
            unset($_SESSION['cart']);
        }
        header('Location: http://' . $_SERVER["SERVER_NAME"] . '/products');
    }
}


/*header('location: /gastCheckout');
          exit;*/

/*$empfaenger = 'empfaenger@example.com';
// Authentifikation mittels SMTP
$this->mailer->isSMTP();
$this->mailer->SMTPAuth = true;


// Login
$this->mailer->Host = "localhost";
$this->mailer->Port = "1025";
$this->mailer->setFrom($email);
$this->mailer->addAddress($empfaenger);
$this->mailer->Username = "";
$this->mailer->Password = "";
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;


$this->mailer->CharSet = 'UTF-8';
$this->mailer->Encoding = 'base64';

$this->mailer->isHTML(true);
$this->mailer->Subject = 'Der Betreff Ihrer Mail';
$this->mailer->Body = 'Der Text Ihrer Mail als HTML-Inhalt. Auch <b>fettgedruckte</b> Elemente sind beispielsweise erlaubt.';
$this->mailer->AltBody = 'Der Text als simples Textelement';
$this->mailer->send();*/


/*$this->item->setName($products);
      //$this->payment->setPaymentMethod("paypal");
      $this->itemList->setItems($this->item);
      $this->transaction->setItemList($this->itemList);
      $this->payment->setIntent('sale');
      $this->payment->setPayer($this->payer);
      $this->transaction->setTransactions(array($this->transaction));

      $apiContext = new \PayPal\Rest\ApiContext(
          new \PayPal\Auth\OAuthTokenCredential(
              'AVCn1pNBfgDgfcu4f0klVIrUV04Fja58_7EAk0MgE6HTW9G1QuZpCE_hBucsyB7Qq3hG-xmcKZNpZAi0',
              'EAbWqgBVCbd65Q1JPJaVCLKjdupcnHgfF2UVBY65Z0nB93vZ0-kIWookh2-C8R1hRupT6fV_EQAHbOX1'
          )
      );

      $this->payment->create($apiContext);
      $approvalUrl = $this->payment->getApprovalLink();
      print_r($approvalUrl);*/

/*$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AVCn1pNBfgDgfcu4f0klVIrUV04Fja58_7EAk0MgE6HTW9G1QuZpCE_hBucsyB7Qq3hG-xmcKZNpZAi0',
        'EAbWqgBVCbd65Q1JPJaVCLKjdupcnHgfF2UVBY65Z0nB93vZ0-kIWookh2-C8R1hRupT6fV_EQAHbOX1'
    )
);

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setTotal('1.00');
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("https://example.com/your_redirect_url.html")
    ->setCancelUrl("https://example.com/your_cancel_url.html");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);


try {
    $payment->create($apiContext);
    echo $payment;

    echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}*/
