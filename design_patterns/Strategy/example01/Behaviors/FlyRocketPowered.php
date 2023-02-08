<?php

namespace Strategy\example01\Behaviors;

class FlyRocketPowered implements FlyBehavior
{
    public function fly(): string
    {
        return "Я летаю на реактивной тяге из попы";
    }
}