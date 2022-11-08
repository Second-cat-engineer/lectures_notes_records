<?php

namespace lesson04\example01\demo07\tests\cost;

use lesson04\example01\demo07\cart\cost\CalculatorInterface;

class DummyCost implements CalculatorInterface
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getCost(array $items)
    {
        return $this->value;
    }
}
