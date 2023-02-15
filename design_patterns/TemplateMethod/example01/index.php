<?php

require_once __DIR__ . '/../../autoload.php';

$tea = new \TemplateMethod\example01\Tea();
$tea->prepareRecipe();

$coffee = new \TemplateMethod\example01\Coffee();
$coffee->prepareRecipe();
