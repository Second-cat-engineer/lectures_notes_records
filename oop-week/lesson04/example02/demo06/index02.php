<?php

use lesson04\example02\cart\Cart;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require_once __DIR__ . '/vendor/autoload.php';

##################################

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load('services.yml');

##################################

/** @var Cart $cart */
$cart = $container->get('cart');

$cart->add(1, 3, 100);
print_r($cart->getItems());