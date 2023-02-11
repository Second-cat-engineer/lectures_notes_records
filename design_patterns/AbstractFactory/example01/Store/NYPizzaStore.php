<?php

namespace AbstractFactory\example01\Store;

use AbstractFactory\example01\NYPizzaIngredientFactory;
use AbstractFactory\example01\Pizza;
use AbstractFactory\example01\PizzaStore;
use Exception;

class NYPizzaStore extends PizzaStore
{
    /**
     * @throws Exception
     */
    protected function createPizza(string $type): Pizza
    {
        $ingredientFactory = new NYPizzaIngredientFactory();

        if ($type === 'cheese') {
            $pizza = new Pizza\CheesePizza($ingredientFactory);
            $pizza->setName('New York style cheese pizza');
        } elseif ($type === 'clam') {
            $pizza = new Pizza\ClamPizza($ingredientFactory);
            $pizza->setName('Ney York style clam pizza');
        } else {
            throw new Exception('Unknown Pizza');
        }

        return $pizza;
    }
}