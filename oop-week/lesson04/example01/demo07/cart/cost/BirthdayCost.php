<?php

namespace lesson04\example01\demo07\cart\cost;

class BirthdayCost implements CalculatorInterface
{
    private CalculatorInterface $next;
    private float $percent;
    private $birthDate;
    private $currentDate;

    public function __construct(CalculatorInterface $next, float $percent, $birthDate, $currentDate)
    {
        $this->next = $next;
        $this->birthDate = $birthDate;
        $this->currentDate = $currentDate;
        $this->percent = $percent;
    }

    public function getCost($items): float|int
    {
        $birthData = \DateTime::createFromFormat('Y-m-d', $this->birthDate);
        $currentData = \DateTime::createFromFormat('Y-m-d', $this->currentDate);

        if ($currentData->format('m-d') == $birthData->format('m-d')) {
            return (1 - $this->percent / 100) * $this->next->getCost($items);
        } else {
            return $this->next->getCost($items);
        }
    }
}
