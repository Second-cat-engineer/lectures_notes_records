<?php

namespace lesson04\example01\demo07\cart\cost;

class NewYearCost implements CalculatorInterface
{
    private CalculatorInterface $next;
    private $month;
    private float $percent;

    public function __construct(CalculatorInterface $next, $month, float $percent)
    {
        $this->next = $next;
        $this->month = $month;
        $this->percent = $percent;
    }

    public function getCost($items): float|int
    {
        $cost = $this->next->getCost($items);
        if ($this->month === 12) {
            return (1 - $this->percent / 100) * $cost;
        } else {
            return $cost;
        }
    }
}
