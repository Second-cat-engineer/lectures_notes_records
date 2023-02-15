<?php

namespace TemplateMethod\example01;

class Tea extends CaffeineBeverage
{
    protected function brew()
    {
        echo 'Steeping the tea'.PHP_EOL;
    }

    protected function addCondiments()
    {
        echo 'Adding lemon'.PHP_EOL;
    }
}