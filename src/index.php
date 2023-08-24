<?php

include_once(__DIR__ . '/../vendor/autoload.php');

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

// get instance of router and "register namespace"
$router = MrStronge\SimpleRouter\Router::get('Mh\Shop');
try {
echo $router();
}catch (\Exception $e) {
    echo $e->getMessage();
}



