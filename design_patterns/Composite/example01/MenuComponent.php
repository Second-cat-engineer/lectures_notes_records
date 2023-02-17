<?php

namespace Composite\example01;

abstract class MenuComponent
{
    public function add(MenuComponent $menuComponent)
    {
        throw new \Exception('Unsupported operation exception');
    }

    public function remove(MenuComponent $menuComponent)
    {
        throw new \Exception('Unsupported operation exception');
    }

    public function getChild(int $i)
    {
        throw new \Exception('Unsupported operation exception');
    }

    public function getName()
    {
        throw new \Exception('Unsupported operation exception');
    }

    public function getDescription()
    {
        throw new \Exception('Unsupported operation exception');
    }

    public function getPrice()
    {
        throw new \Exception('Unsupported operation exception');
    }

    public function isVegetarian()
    {
        throw new \Exception('Unsupported operation exception');
    }

    public function print()
    {
        throw new \Exception('Unsupported operation exception');
    }
}