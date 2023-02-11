<?php

namespace FactoryMethod\example01\Pizza;

use FactoryMethod\example01\Pizza;

class ChicagoStyleCheesePizza extends Pizza
{
    public function __construct()
    {
        $this->name = 'Chicago Style Deep Dish Cheese Pizza';
        $this->dough = 'Extra Thick Crust Dough';
        $this->sauce = 'Plum Tomato Sauce';

        $this->toppings[] = 'Shredded Mozzarella Cheese';
    }

    public function cut(): string
    {
        return 'Cutting the pizza into square slices';
    }
}