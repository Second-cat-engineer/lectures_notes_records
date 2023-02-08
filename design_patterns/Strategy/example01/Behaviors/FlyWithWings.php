<?php

namespace Strategy\example01\Behaviors;

class FlyWithWings implements FlyBehavior
{
    public function fly(): string
    {
        return "Реализация полета для 'Я умею летать!'";
    }
}