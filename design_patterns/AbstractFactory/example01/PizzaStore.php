<?php

namespace AbstractFactory\example01;

use AbstractFactory\example01\Pizza;

abstract class PizzaStore
{
    protected array $types = [
        'cheese',
    ];

    public function orderPizza(string $type): Pizza
    {
        if (!in_array($type, $this->types)) {
            echo 'Unknown pizza';
        }

        $pizza = $this->createPizza($type);

        echo $pizza->prepare() . PHP_EOL;
        echo $pizza->bake() . PHP_EOL;
        echo $pizza->cut() . PHP_EOL;
        echo $pizza->box() . PHP_EOL;

        return $pizza;
    }

    abstract protected function createPizza(string $type): Pizza;
}