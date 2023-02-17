<?php

require_once __DIR__ . '/../../autoload.php';

$pancakeMenu = new \Composite\example01\Menu('Pancke house Menu', 'Breakfast');
$dinerMenu = new \Composite\example01\Menu('Diner Menu', 'Lunch');
$cafeMenu = new \Composite\example01\Menu('CAFE Menu', 'Diner');
$desertMenu = new \Composite\example01\Menu('DESSERT Menu', 'Dessert of corse');

$pancakeMenu->add(new \Composite\example01\MenuItem('Pancake 1', 'desc pancake one', true, 1));
$pancakeMenu->add(new \Composite\example01\MenuItem('Pancake 2', 'desc pancake two', false, 5));
$pancakeMenu->add(new \Composite\example01\MenuItem('Pancake 3', 'desc pancake three', false, 3));
$pancakeMenu->add(new \Composite\example01\MenuItem('Pancake 4', 'desc pancake four', true, 10));


$dinerMenu->add(new \Composite\example01\MenuItem('Diner 1', 'desc Diner one', false, 10));
$dinerMenu->add(new \Composite\example01\MenuItem('Diner 2', 'desc Diner two', false, 60));
$dinerMenu->add(new \Composite\example01\MenuItem('Diner 3', 'desc Diner three', false, 32));
$dinerMenu->add(new \Composite\example01\MenuItem('Diner 4', 'desc Diner four', true, 42));
$dinerMenu->add(new \Composite\example01\MenuItem('pasta', 'spaghetti', false, 23));
$dinerMenu->add($desertMenu);

$desertMenu->add(new \Composite\example01\MenuItem('Apple pie', 'pppppp', true, 12));

$allMenu = new \Composite\example01\Menu('All Menus', 'All menu combined');

$allMenu->add($pancakeMenu);
$allMenu->add($dinerMenu);
$allMenu->add($cafeMenu);

$waitress = new \Composite\example01\Waitress($allMenu);
$waitress->printMenu();
