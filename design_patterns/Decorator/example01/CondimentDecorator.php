<?php

namespace Decorator\example01;

abstract class CondimentDecorator extends Beverage
{
    protected Beverage $beverage;

    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }
}