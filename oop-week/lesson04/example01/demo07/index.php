<?php
require_once __DIR__ . '/vendor/autoload.php';

use lesson04\example01\demo07\cart\Cart;
use lesson04\example01\demo07\cart\cost\BigCost;
use lesson04\example01\demo07\cart\cost\BirthdayCost;
use lesson04\example01\demo07\cart\cost\FridayCost;
use lesson04\example01\demo07\cart\cost\MinCost;
use lesson04\example01\demo07\cart\cost\NewYearCost;
use lesson04\example01\demo07\cart\cost\SimpleCost;
use lesson04\example01\demo07\cart\storage\SessionStorage;

$storage = new SessionStorage('cart');

$simpleCost = new SimpleCost();
$calculator = new MinCost(
    new FridayCost($simpleCost, 5, date('Y-m-d')),
    new NewYearCost($simpleCost, date('m'), 3),
    new BigCost($simpleCost, 100, 20)
);

//if (!Yii::$app->user->isGuest) {
//    $calculator = new BirthdayCost($calculator, 7, Yii::$app->user->identity->birthDate, date('Y-m-d'));
//}

$cart = new Cart($storage, $calculator);

$cart->add(5, 6, 100);

echo $cart->getCost() . PHP_EOL;
