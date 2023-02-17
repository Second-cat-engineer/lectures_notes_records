<?php

namespace Composite\example01;

class Waitress
{
    protected MenuComponent $allMenus;

    public function __construct($allMenus)
    {
        $this->allMenus = $allMenus;
    }

    public function printMenu()
    {
        $this->allMenus->print();

    }
}