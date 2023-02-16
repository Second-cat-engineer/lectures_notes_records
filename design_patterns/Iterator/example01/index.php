<?php

require_once __DIR__ . '/../../autoload.php';

$pancake = new \Iterator\example01\Menu\PancakeHouseMenu();
$diner = new \Iterator\example01\Menu\DinerMenu();

$waitress = new \Iterator\example01\Waitress($pancake, $diner);
$waitress->printMenu();