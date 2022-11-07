<?php

namespace lesson04\example01\demo07\cart\cost;

class NewYearCost implements CalculatorInterface
{
    private $next;
    private $month;
    private $percent;

    public function __construct(CalculatorInterface $next, $month, $percent)
    {
        $this->next = $next;
        $this->month = $month;
        $this->percent = $percent;
    }

    public function getCost($items)
    {
        $cost = $this->next->getCost($items);
        if ($this->month === 12) {
            return (1 - $this->percent / 100) * $cost;
        } else {
            return $cost;
        }
    }
}
