<?php

namespace lesson04\example01\demo07\tests\cost;

use lesson04\example01\demo07\cart\cost\BirthdayCost;
use PHPUnit\Framework\TestCase;

class BirthdayCostTest extends TestCase
{
    public function testActive()
    {
        $calc = new BirthdayCost(new DummyCost(100), 5, '1993-24-01', '2022-24-01');
        $this->assertEquals(95, $calc->getCost([]));
    }

    public function testNone()
    {
        $calc = new BirthdayCost(new DummyCost(100), 5, '1993-24-01', '2022-25-01');
        $this->assertEquals(100, $calc->getCost([]));
    }
}
