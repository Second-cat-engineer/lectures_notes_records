<?php

namespace lesson04\example02\cart\cost;

class FridayCost implements CalculatorInterface
{
    private CalculatorInterface $next;
    private float $percent;
    private $date;

    public function __construct(CalculatorInterface $next, float $percent, $date)
    {
        $this->next = $next;
        $this->date = $date;
        $this->percent = $percent;
    }

    public function getCost($items): float|int
    {
        $now = \DateTime::createFromFormat('Y-m-d', $this->date);
        if ($now->format('l') == 'Friday') {
            return (1 - $this->percent / 100) * $this->next->getCost($items);
        } else {
            return $this->next->getCost($items);
        }
    }
}
