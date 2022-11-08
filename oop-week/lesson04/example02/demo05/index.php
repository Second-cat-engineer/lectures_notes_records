<?php

use lesson04\example02\cart\Cart;
use lesson04\example02\cart\storage\SessionStorage;
use yii\di\Container;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

$container = Yii::$container;

$container->set('lesson04\example02\cart\storage\StorageInterface', function (Container $container) {
    return new SessionStorage('cart');
});

$container->set('lesson04\example02\cart\cost\CalculatorInterface', 'lesson04\example02\cart\cost\SimpleCost');
//var_dump($container); die();
$container->setSingleton('lesson04\example02\cart\Cart');

// или
//$container->setSingleton('cart', 'lesson04\example02\cart\Cart');

// или
//$container->setSingleton('cart', function (Container $container) {
//    return new Cart(
//        $container->get('lesson04\example02\cart\storage\SessionStorage'),
//        $container->get('lesson04\example02\cart\cost\SimpleCost')
//    );
//});
//var_dump($container); die();
##################################

/** @var Cart $cart */
$cart = Yii::createObject('lesson04\example02\cart\Cart'); // обертка над $container->get();
//$cart = $container->get('lesson04\example02\cart\Cart');
//$cart = $container->get('cart');

$cart->add(1, 3, 100);
print_r($cart->getItems());