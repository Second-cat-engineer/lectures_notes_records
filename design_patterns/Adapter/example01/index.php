<?php

require_once __DIR__ . '/../../autoload.php';

$turkey = new \Adapter\example01\Turkey();
echo 'Индюк говорит что: '.PHP_EOL;
$turkey->gobble();
$turkey->fly();


$duck = new \Adapter\example01\Duck();
echo PHP_EOL.'А утка в ответ: '.PHP_EOL;
$duck->quack();
$duck->fly();


echo PHP_EOL.'Индюк психанул и преобразовался в утку'.PHP_EOL;
$turkeyAdapter = new \Adapter\example01\TurkeyAdapter($turkey);
$turkeyAdapter->quack();
$turkeyAdapter->fly();