<?php

namespace lesson04\example01\demo07\tests\cost;

use lesson04\example01\demo07\cart\cost\BigCost;
use PHPUnit\Framework\TestCase;

class BigCostTest extends TestCase
{
    public function testActive()
    {
        $calculator = new BigCost(new DummyCost(1000), 500, 10);
        $this->assertEquals(900, $calculator->getCost([]));
    }

    public function testNone()
    {
        $calculator = new BigCost(new DummyCost(100), 500, 10);
        $this->assertEquals(100, $calculator->getCost([]));
    }
}
