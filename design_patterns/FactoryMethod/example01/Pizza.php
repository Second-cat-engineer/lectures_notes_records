<?php

namespace FactoryMethod\example01;

abstract class Pizza
{
    protected string $name;
    protected string $dough;
    protected string $sauce;
    protected array $toppings = [];

    public function prepare(): string
    {
        $res = 'Preparing ' . $this->name . PHP_EOL;
        $res .= 'Tossing dough...'.PHP_EOL;
        $res .= 'Adding sauce...'.PHP_EOL;
        $res .= 'Adding toppings: ';
        foreach ($this->toppings as $topping) {
            $res .= ' ' . $topping;
        }
        $res .= PHP_EOL;

        return $res;
    }

    public function bake(): string
    {
        return 'Bake for 15 minutes at 250';
    }

    public function cut(): string
    {
        return 'Cutting the pizza into diagonal slices';
    }

    public function box(): string
    {
        return 'Place pizza in official PizzaStore box';
    }

    public function getName(): string
    {
        return $this->name;
    }
}