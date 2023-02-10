<?php

namespace Decorator\example01;

abstract class Beverage
{
    protected string $description = "Unknown Beverage";

    public function getDescription(): string
    {
        return $this->description;
    }

    abstract public function cost(): int;
}