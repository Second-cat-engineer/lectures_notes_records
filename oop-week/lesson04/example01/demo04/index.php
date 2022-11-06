<?php

use lesson04\example01\demo04\cart\Cart;

require_once __DIR__ . '/vendor/autoload.php';

echo 'Create cart' . PHP_EOL;

$cart = new Cart();
print_r($cart->getItems());

echo 'Add item' . PHP_EOL;

$cart->add(5, 6);
$cart->add(7, 12);
print_r($cart->getItems());

echo 'Remove item' . PHP_EOL;

$cart->remove(5);
print_r($cart->getItems());

echo 'Clear' . PHP_EOL;

$cart->clear();
print_r($cart->getItems());
