<?php

namespace TemplateMethod\example01;

class Coffee extends CaffeineBeverage
{
    protected function brew()
    {
        echo 'Dripping Coffee through filter'.PHP_EOL;
    }

    protected function addCondiments()
    {
        echo 'Adding Sugar and Milk'.PHP_EOL;
    }
}