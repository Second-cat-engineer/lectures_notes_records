<?php

namespace FactoryMethod\example02\Creator;

use FactoryMethod\example02\Creator;
use FactoryMethod\example02\Product\Product1;

class Creator1 extends Creator
{
    public function factoryMethod(): Product1
    {
        return new Product1();
    }
}