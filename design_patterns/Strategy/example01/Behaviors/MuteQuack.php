<?php

namespace Strategy\example01\Behaviors;

class MuteQuack implements QuackBehavior
{
    public function quack(): string
    {
        return "Я не умею крякать. Я только молчу.";
    }
}