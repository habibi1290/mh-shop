<?php
namespace Mh\Shop\Controller;


use Mh\Shop\Repository\CategoryRepository;
use Mh\Shop\Repository\LoginRepository;
use MrStronge\SimpleRouter\Attributes\Get;
use MrStronge\SimpleRouter\Attributes\Post;

class LoginController extends \Mh\Shop\Utility\View
{

    protected CategoryRepository $categoryRepository;
    protected LoginRepository $loginRepository;
    public function __construct()
    {
        $this->loginRepository  = new LoginRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    #[Get('/product/login')]
    public function login(): void
    {
        $this->render('Login/login', []);
    }

    #[Post('/product/login')]
    public function sendLogin(): void
    {
        if(!empty($_POST)) {
            $username = $_POST['email'];
            $password = $_POST['password'];

            if (!empty($username) && !empty($password)) {
                if ($this->loginRepository->handleLogin($username, $password)) {
                    header('location: /checkout');
                } else {
                    $this->login();
                }
            }
        }
    }

    #[Get('/product/logout')]
    public function logout(): void
    {
        $logout = $this->loginRepository->logout();
        $this->render('Login/login', ['logout', $logout]);
    }

}
