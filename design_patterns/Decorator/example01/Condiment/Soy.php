<?php

namespace Decorator\example01\Condiment;

use Decorator\example01\CondimentDecorator;

class Soy extends CondimentDecorator
{
    public function getDescription(): string
    {
        return $this->beverage->getDescription() . ', Soy';
    }

    public function cost(): int
    {
        return $this->beverage->cost() + 50;
    }
}