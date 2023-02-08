<?php

namespace Strategy\example01\Behaviors;

class FlyNoWay implements FlyBehavior
{
    public function fly(): string
    {
        return "Реализация полета для 'Я НЕ умею летать!'";
    }
}