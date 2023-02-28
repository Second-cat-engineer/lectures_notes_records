<?php

namespace FactoryMethod\example02\Creator;

use FactoryMethod\example02\Creator;
use FactoryMethod\example02\Product\Product2;

class Creator2 extends Creator
{
    public function factoryMethod(): Product2
    {
        return new Product2();
    }
}