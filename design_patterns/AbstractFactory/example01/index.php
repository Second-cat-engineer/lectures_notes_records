<?php

use AbstractFactory\example01\Store\NYPizzaStore;

require_once __DIR__ . '/../../autoload.php';

$pizzaStoreNY = new NYPizzaStore();

$pizza = $pizzaStoreNY->orderPizza('cheese');
echo 'First cat ordered a ' . $pizza->getName() .PHP_EOL;

//$secondPizza = $pizzaStoreChicago->orderPizza('cheese');
//echo 'Second cat ordered a ' . $secondPizza->getName() .PHP_EOL;