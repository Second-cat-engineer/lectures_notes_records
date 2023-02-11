<?php

namespace AbstractFactory\example01\Pizza;

use AbstractFactory\example01\Pizza;
use AbstractFactory\example01\PizzaIngredientFactoryInterface;

class ClamPizza extends Pizza
{
    protected PizzaIngredientFactoryInterface $ingredientFactory;

    public function __construct(PizzaIngredientFactoryInterface $pizzaIngredientFactory)
    {
        $this->ingredientFactory = $pizzaIngredientFactory;
    }

    public function prepare()
    {
        echo 'Preparing ' . $this->name . PHP_EOL;
        $this->dough = $this->ingredientFactory->createDough();
        $this->sauce = $this->ingredientFactory->createSauce();
        $this->cheese = $this->ingredientFactory->createCheese();
        $this->clams = $this->ingredientFactory->createClam();
    }
}