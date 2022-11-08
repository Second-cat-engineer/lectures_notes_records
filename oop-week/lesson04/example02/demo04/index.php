<?php

use lesson04\example02\cart\storage\SessionStorage;
use lesson04\example02\demo04\Container;

require_once __DIR__ . '/vendor/autoload.php';

$container = new Container();

$container->set('lesson04\example02\cart\storage\StorageInterface', function (Container $container) {
    return new SessionStorage('cart');
});
$container->set('lesson04\example02\cart\cost\CalculatorInterface', 'lesson04\example02\cart\cost\SimpleCost');
$container->setShared('cart', 'lesson04\example02\cart\Cart');
//var_dump($container); die();
##################################

$cart = $container->get('cart');

$cart->add(1, 3, 100);
print_r($cart->getItems());

$cart2 = $container->get('cart');
$cart2->add(2, 2, 200);
print_r($cart2->getItems());