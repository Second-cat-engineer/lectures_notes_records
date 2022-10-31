<?php
class Discount
{
    private int $limit;
    private int $percent;

    public function __construct(int $limit, int $percent)
    {
        $this->limit = $limit;
        $this->percent = $percent;
    }

    public function calcCost(int $cost): float|int
    {
        if ($cost >= $this->limit) {
            return $cost * (1 - $this->percent / 100);
        }

        return $cost;
    }
}

$discount1 = new Discount(1000, 5);
$discount2 = new Discount(1200, 7);

echo $discount1->calcCost(1200) . PHP_EOL;
echo $discount2->calcCost(1200) . PHP_EOL;