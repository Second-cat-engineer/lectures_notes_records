<?php

namespace lesson04\example02\cart\cost;

class SimpleCost implements CalculatorInterface
{
    public function getCost($items): float|int
    {
        $cost = 0;
        foreach ($items as $item) {
            $cost += $item->getCost();
        }
        return $cost;
    }
}
