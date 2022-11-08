<?php

use lesson04\example02\cart\Cart;
use lesson04\example02\cart\cost\SimpleCost;
use lesson04\example02\cart\storage\SessionStorage;

require_once __DIR__ . '/vendor/autoload.php';

$cart = new Cart(new SessionStorage('cart'), new SimpleCost());

$cart->add(1, 3, 100);
print_r($cart->getItems());
