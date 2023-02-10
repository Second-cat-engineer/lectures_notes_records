<?php

namespace Decorator\example01\Coffee;

use Decorator\example01\Beverage;

class DarkRoast extends Beverage
{
    public function __construct()
    {
        $this->description = 'Dark Roast';
    }

    public function cost(): int
    {
        return 200;
    }
}