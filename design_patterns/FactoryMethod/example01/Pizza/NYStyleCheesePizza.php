<?php

namespace FactoryMethod\example01\Pizza;

use FactoryMethod\example01\Pizza;

class NYStyleCheesePizza extends Pizza
{
    public function __construct()
    {
        $this->name = 'NY Style Sauce and Cheese Pizza';
        $this->dough = 'Thin Crust Dough';
        $this->sauce = 'Marinara Souce';

        $this->toppings[] = 'Crated Reggiano Cheese';
    }
}