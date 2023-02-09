<?php

require_once __DIR__ . '/../../autoload.php';

use Observer\example01\WeatherData;
use Observer\example01\CurrentConditionsDisplay;

$weatherData = new WeatherData();

$display = new CurrentConditionsDisplay($weatherData);

$weatherData->setMeasurements(80, 65, 30.4);
$weatherData->setMeasurements(82, 70, 29.4);
$weatherData->setMeasurements(78, 80, 29.8);
$weatherData->setMeasurements(65, 90, 30.4);