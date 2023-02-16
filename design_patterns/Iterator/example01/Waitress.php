<?php

namespace Iterator\example01;

use Iterator\example01\Menu\MenuItem;
use Iterator\example01\Menu\DinerMenu;
use Iterator\example01\Menu\PancakeHouseMenu;

class Waitress
{
    protected PancakeHouseMenu $pancakeHouseMenu;
    protected DinerMenu $dinerMenu;

    public function __construct($pancakeHouseMenu, $dinerMenu)
    {
        $this->pancakeHouseMenu = $pancakeHouseMenu;
        $this->dinerMenu = $dinerMenu;
    }

    public function printMenu()
    {
        $pancakeIterator = $this->pancakeHouseMenu->createIterator();
        $dinerIterator = $this->dinerMenu->createIterator();

        echo 'MENU BREAKFAST'.PHP_EOL;
        $this->printMenuItem($pancakeIterator);

        echo 'LUNCH MENU'.PHP_EOL;
        $this->printMenuItem($dinerIterator);

    }

    protected function printMenuItem(IteratorInterface $iterator)
    {
        while ($iterator->hasNext()) {
            /** Iterator\example01\Menu\MenuItem $item */
            $item = $iterator->next();

            echo $item->getName().', '.$item->getPrice().' -- '.$item->getDescription().PHP_EOL;
        }

        echo PHP_EOL;
    }
}