<?php

use lesson04\example02\cart\Cart;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

require_once __DIR__ . '/vendor/autoload.php';

$container = new ContainerBuilder();

$container->setParameter('cart.storage.session_key', 'cart');

$container
    ->register('cart.storage.session', 'lesson04\example02\cart\storage\SessionStorage')
    ->addArgument('%cart.storage.session_key%')
    ->setShared(false);

$container
    ->register('cart.calculator', 'lesson04\example02\cart\cost\SimpleCost');

$container
    ->register('cart', 'lesson04\example02\cart\Cart')
    ->addArgument(new Reference('cart.storage.session'))
    ->addArgument(new Reference('cart.calculator'));

##################################

/** @var Cart $cart */
$cart = $container->get('cart');

$cart->add(1, 3, 100);
print_r($cart->getItems());