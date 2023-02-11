<?php

namespace AbstractFactory\example01\Pizza;

use AbstractFactory\example01\Pizza;
use AbstractFactory\example01\PizzaIngredientFactoryInterface;

class CheesePizza extends Pizza
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

        echo '1: '.$this->dough->name . '. 2: '.$this->sauce->name.'. 3: '.$this->cheese->name.PHP_EOL;
    }
}