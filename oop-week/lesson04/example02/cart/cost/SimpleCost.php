<?php

namespace lesson04\example02\cart\cost;

class SimpleCost implements CalculatorInterface
{
    public function getCost($items)
    {
        $cost = 0;
        foreach ($items as $item) {
            $cost += $item->getCost();
        }
        return $cost;
    }
}
