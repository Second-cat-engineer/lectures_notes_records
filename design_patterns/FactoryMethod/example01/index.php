<?php

use FactoryMethod\example01\Store\ChicagoStylePizzaStore;
use FactoryMethod\example01\Store\NYStylePizzaStore;

require_once __DIR__ . '/../../autoload.php';

$pizzaStoreNY = new NYStylePizzaStore();
$pizzaStoreChicago = new ChicagoStylePizzaStore();

$pizza = $pizzaStoreNY->orderPizza('cheese');
echo 'First cat ordered a ' . $pizza->getName() .PHP_EOL;

$secondPizza = $pizzaStoreChicago->orderPizza('cheese');
echo 'Second cat ordered a ' . $secondPizza->getName() .PHP_EOL;