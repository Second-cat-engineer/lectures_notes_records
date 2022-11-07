<?php

namespace lesson04\example01\demo07\tests\cost;

use lesson04\example01\demo07\cart\CartItem;
use lesson04\example01\demo07\cart\cost\SimpleCost;
use PHPUnit\Framework\TestCase;

class SimpleCostTest extends TestCase
{
    public function testCalculate()
    {
        $calculator = new SimpleCost();
        $this->assertEquals(1000, $calculator->getCost([
            5 => new CartItem(5, 2, 200),
            7 => new CartItem(7, 4, 150),
        ]));
    }
}
