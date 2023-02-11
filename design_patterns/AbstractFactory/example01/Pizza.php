<?php

namespace AbstractFactory\example01;

use AbstractFactory\example01\Ingredient\Cheese;
use AbstractFactory\example01\Ingredient\Clam;
use AbstractFactory\example01\Ingredient\Dough;
use AbstractFactory\example01\Ingredient\Pepperoni;
use AbstractFactory\example01\Ingredient\Sauce;

abstract class Pizza
{
    protected string $name;
    protected Dough $dough; // может быть Интерфейсом
    protected Sauce $sauce; // может быть Интерфейсом
    protected array $veggies = []; // может быть Интерфейсом
    protected Cheese $cheese; // может быть Интерфейсом
    protected Pepperoni $pepperoni; // может быть Интерфейсом
    protected Clam $clams; // может быть Интерфейсом

    abstract public function prepare();

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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toString()
    {
        // Код вывода описания пиццы.
    }
}