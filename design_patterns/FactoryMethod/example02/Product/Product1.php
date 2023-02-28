<?php

namespace FactoryMethod\example02\Product;

use FactoryMethod\example02\Product;

class Product1 implements Product
{
    public function operation(): string
    {
        return "{Result of the ConcreteProduct1}";
    }
}