<?php

namespace Strategy\example01\Behaviors;

class Quack implements QuackBehavior
{
    public function quack(): string
    {
        return "кря кря кря кря кряяя";
    }
}