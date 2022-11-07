<?php

namespace lesson04\example01\demo07\cart\cost;

class FridayCost implements CalculatorInterface
{
    private $next;
    private $percent;
    private $date;

    public function __construct(CalculatorInterface $next, $percent, $date)
    {
        $this->next = $next;
        $this->date = $date;
        $this->percent = $percent;
    }

    public function getCost($items)
    {
        $now = \DateTime::createFromFormat('Y-m-d', $this->date);
        if ($now->format('l') == 'Friday') {
            return (1 - $this->percent / 100) * $this->next->getCost($items);
        } else {
            return $this->next->getCost($items);
        }
    }
}
