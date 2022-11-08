<?php

namespace lesson04\example02\cart\cost;

class BigCost implements CalculatorInterface
{
    private CalculatorInterface $next;
    private $limit;
    private float $percent;

    public function __construct(CalculatorInterface $next, $limit, float $percent)
    {
        $this->next = $next;
        $this->limit = $limit;
        $this->percent = $percent;
    }

    public function getCost($items): float|int
    {
        $cost = $this->next->getCost($items);
        if ($cost > $this->limit) {
            return (1 - $this->percent / 100) * $cost;
        } else {
            return $cost;
        }
    }
}
