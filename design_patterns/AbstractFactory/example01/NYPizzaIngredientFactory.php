<?php

namespace AbstractFactory\example01;

use AbstractFactory\example01\Ingredient\Cheese;
use AbstractFactory\example01\Ingredient\Clam;
use AbstractFactory\example01\Ingredient\Dough;
use AbstractFactory\example01\Ingredient\Pepperoni;
use AbstractFactory\example01\Ingredient\Sauce;
use AbstractFactory\example01\Ingredient\Veggies;

class NYPizzaIngredientFactory implements PizzaIngredientFactoryInterface
{
    public function createDough()
    {
        return new Dough();
    }

    public function createSauce()
    {
        return new Sauce();
    }

    public function createCheese()
    {
        return new Cheese();
    }

    public function createVeggies()
    {
        return new Veggies();
    }

    public function createPepperoni()
    {
        return new Pepperoni();
    }

    public function createClam()
    {
        return new Clam();
    }
}