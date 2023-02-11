<?php

namespace FactoryMethod\example01\Store;

use FactoryMethod\example01\Pizza\NYStyleCheesePizza;
use FactoryMethod\example01\Pizza;
use FactoryMethod\example01\PizzaStore;

class NYStylePizzaStore extends PizzaStore
{
    protected function createPizza(string $type): Pizza
    {
        switch ($type) {
            case 'cheese':
                return new NYStyleCheesePizza();
        }
    }
}