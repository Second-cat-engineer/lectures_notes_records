<?php

namespace FactoryMethod\example01\Store;

use FactoryMethod\example01\PizzaStore;
use FactoryMethod\example01\Pizza;
use FactoryMethod\example01\Pizza\ChicagoStyleCheesePizza;

class ChicagoStylePizzaStore extends PizzaStore
{
    protected function createPizza(string $type): Pizza
    {
        switch ($type) {
            case 'cheese':
                return new ChicagoStyleCheesePizza();
        }
    }
}