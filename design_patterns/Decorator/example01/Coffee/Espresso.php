<?php

namespace Decorator\example01\Coffee;

use Decorator\example01\Beverage;

class Espresso extends Beverage
{
    public function __construct()
    {
        $this->description = 'Espresso';
    }

    public function cost(): int
    {
        return 120;
    }
}