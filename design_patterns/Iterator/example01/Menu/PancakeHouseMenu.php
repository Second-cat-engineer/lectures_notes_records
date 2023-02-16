<?php

namespace Iterator\example01\Menu;

use Iterator\example01\Iterator\DinerMenuIterator;
use Iterator\example01\IteratorInterface;

class PancakeHouseMenu
{
    protected array $menuItems = []; // Типа один способ хранения

    public function __construct()
    {
        $this->addItem('Pancake 1', 'desc pancake one', true, 1);
        $this->addItem('Pancake 2', 'desc pancake two', false, 5);
        $this->addItem('Pancake 3', 'desc pancake three', false, 3);
        $this->addItem('Pancake 4', 'desc pancake four', true, 10);
    }

    public function addItem(string $name, string $description, bool $vegetarian, int $price)
    {
        $this->menuItems[] = new MenuItem($name, $description, $vegetarian, $price);
    }

    public function createIterator(): IteratorInterface
    {
        return new DinerMenuIterator($this->menuItems);
    }

    // other methods.....
}