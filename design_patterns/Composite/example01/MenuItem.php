<?php

namespace Composite\example01;

class MenuItem extends MenuComponent
{
    protected string $name;
    protected string $description;
    protected bool $vegetarian;
    protected int $price;

    public function __construct(string $name, string $description, bool $vegetarian, int $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->vegetarian = $vegetarian;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function isVegetarian()
    {
        return $this->vegetarian;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function print()
    {
        $str = $this->getName() .', ';
        if ($this->isVegetarian()) {
            $str .= 'v, ';
        }
        $str .= $this->getPrice() .' -- ' .$this->getDescription() .PHP_EOL;

        echo $str;
    }
}