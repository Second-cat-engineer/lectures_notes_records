<?php

namespace Decorator\example01\Condiment;

use Decorator\example01\CondimentDecorator;

class Mocha extends CondimentDecorator
{
    public function getDescription(): string
    {
        return $this->beverage->getDescription() . ', Mocha';
    }

    public function cost(): int
    {
        return $this->beverage->cost() + 20;
    }
}