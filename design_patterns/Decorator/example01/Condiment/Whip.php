<?php

namespace Decorator\example01\Condiment;

use Decorator\example01\CondimentDecorator;

class Whip extends CondimentDecorator
{
    public function getDescription(): string
    {
        return $this->beverage->getDescription() . ', Whip';
    }

    public function cost(): int
    {
        return $this->beverage->cost() + 20;
    }
}