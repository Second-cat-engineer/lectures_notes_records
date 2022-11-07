<?php

namespace lesson04\example01\demo07\cart\cost;

use lesson04\example01\demo07\cart\CartItem;

interface CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return float
     */
    public function getCost(array $items);
}
