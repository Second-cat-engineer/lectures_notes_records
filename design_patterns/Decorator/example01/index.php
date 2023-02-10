<?php

require_once __DIR__ . '/../../autoload.php';

use Decorator\example01\Coffee\DarkRoast;
use Decorator\example01\Coffee\Espresso;
use Decorator\example01\Coffee\HouseBlend;
use Decorator\example01\Condiment\Mocha;
use Decorator\example01\Condiment\Soy;
use Decorator\example01\Condiment\Whip;

$espresso = new Espresso();
echo $espresso->getDescription() . ' - ' . $espresso->cost() . PHP_EOL;

$darkRoast = new DarkRoast();
$darkRoast = new Mocha($darkRoast);
$darkRoast = new Mocha($darkRoast);
$darkRoast = new Whip($darkRoast);
echo $darkRoast->getDescription() . ' - ' . $darkRoast->cost() . PHP_EOL;

$houseBlend = new HouseBlend();
$houseBlend = new Soy($houseBlend);
$houseBlend = new Mocha($houseBlend);
$houseBlend = new Whip($houseBlend);
echo $houseBlend->getDescription() . ' - ' . $houseBlend->cost() . PHP_EOL;