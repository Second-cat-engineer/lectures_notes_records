<?php

namespace Strategy\example01;

use Strategy\example01\Behaviors\FlyBehavior;
use Strategy\example01\Behaviors\QuackBehavior;

abstract class Duck
{
    protected FlyBehavior $flyBehavior;
    protected QuackBehavior $quackBehavior;

    abstract public function display();

    public function performFly()
    {
        return $this->flyBehavior->fly();
    }

    public function performQuack()
    {
        return $this->quackBehavior->quack();
    }

    public function swim()
    {
        return "Все утки умеют плавать";
    }

    //===================================================
    // Чтоб была возможность динамически менять поведение.
    public function setFlyBehavior(FlyBehavior $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function setQuackBehavior(QuackBehavior $quackBehavior): void
    {
        $this->quackBehavior = $quackBehavior;
    }
    //===================================================
}