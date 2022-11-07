<?php

use lesson04\example01\demo06\cart\Cart;
use lesson04\example01\demo06\cart\storage\SessionStorage;

require_once __DIR__ . '/vendor/autoload.php';

echo 'Create cart' . PHP_EOL;

$storage = new SessionStorage('cart');
$cart = new Cart($storage);
print_r($cart->getItems());

echo 'Add item' . PHP_EOL;

$cart->add(5, 6, 100);
echo $cart->getCost() . PHP_EOL;
