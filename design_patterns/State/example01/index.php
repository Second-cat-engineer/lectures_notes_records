<?php

require_once __DIR__ . '/../../autoload.php';

$gumballMachine = new \State\example01\GumballMachine(10);

$gumballMachine->insertQuarter();
$gumballMachine->turnCrank();

$gumballMachine->insertQuarter();
$gumballMachine->turnCrank();
$gumballMachine->insertQuarter();
$gumballMachine->turnCrank();

$gumballMachine->turnCrank();
$gumballMachine->ejectQuarter();
