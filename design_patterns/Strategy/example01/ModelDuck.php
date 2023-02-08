<?php

namespace Strategy\example01;

use Strategy\example01\Behaviors\FlyNoWay;
use Strategy\example01\Behaviors\Quack;

class ModelDuck extends Duck
{
    public function __construct()
    {
        $this->flyBehavior = new FlyNoWay();
        $this->quackBehavior = new Quack();
    }

    public function display(): string
    {
        return "Я модель утки.";
    }
}