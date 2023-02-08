<?php

namespace Strategy\example01;

use Strategy\example01\Behaviors\FlyWithWings;
use Strategy\example01\Behaviors\Quack;

class MallardDuck extends Duck
{
    public function __construct()
    {
        $this->flyBehavior = new FlyWithWings();
        $this->quackBehavior = new Quack();
    }

    public function display(): string
    {
        return "Я реальная живая утка";
    }
}