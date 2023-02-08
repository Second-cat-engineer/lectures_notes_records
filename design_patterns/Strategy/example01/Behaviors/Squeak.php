<?php

namespace Strategy\example01\Behaviors;

class Squeak implements QuackBehavior
{
    public function quack(): string
    {
        return "Пищууу";
    }
}