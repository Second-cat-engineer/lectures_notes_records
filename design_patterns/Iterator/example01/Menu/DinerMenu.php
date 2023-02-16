<?php

namespace Iterator\example01\Menu;

use Iterator\example01\Iterator\DinerMenuIterator;
use Iterator\example01\IteratorInterface;

class DinerMenu
{
    protected array $menuItems = []; // Типа один способ хранения
    protected const MAX_ITEMS = 6;

    public function __construct()
    {
        $this->addItem('Diner 1', 'desc Diner one', false, 10);
        $this->addItem('Diner 2', 'desc Diner two', false, 60);
        $this->addItem('Diner 3', 'desc Diner three', false, 32);
        $this->addItem('Diner 4', 'desc Diner four', true, 42);
    }

    public function addItem(string $name, string $description, bool $vegetarian, int $price)
    {
        if (count($this->menuItems) >= self::MAX_ITEMS) {
            throw new \Exception('Can\'t add item to menu.');
        }
        $this->menuItems[] = new MenuItem($name, $description, $vegetarian, $price);
    }

    public function createIterator(): IteratorInterface
    {
        return new DinerMenuIterator($this->menuItems);
    }

    // other methods.....
}