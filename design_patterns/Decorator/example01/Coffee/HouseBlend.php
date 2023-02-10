<?php

namespace Decorator\example01\Coffee;

use Decorator\example01\Beverage;

class HouseBlend extends Beverage
{
    public function __construct()
    {
        $this->description = 'House Blend Coffee';
    }

    public function cost(): int
    {
        return 150;
    }
}