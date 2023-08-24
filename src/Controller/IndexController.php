<?php
namespace Mh\Shop\Controller;

use MrStronge\SimpleRouter\Attributes\Get;

class IndexController {

    #[Get('/')]
    public function index(): mixed {
        //return "index";
        return null;
    }

}
