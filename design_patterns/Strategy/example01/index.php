<?php

require_once __DIR__ . '/../../autoload.php';

use Strategy\example01\MallardDuck;

$duck = new MallardDuck();
echo $duck->performQuack() . PHP_EOL;
echo $duck->performFly() . PHP_EOL;

// Динамическое изменение поведения для ModelDuck;
$modelDuck = new \Strategy\example01\ModelDuck();
echo $modelDuck->performQuack() . PHP_EOL;
echo $modelDuck->performFly() . PHP_EOL;

$modelDuck->setFlyBehavior(new \Strategy\example01\Behaviors\FlyRocketPowered());
echo $modelDuck->performFly() . PHP_EOL;