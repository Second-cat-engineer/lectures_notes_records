<?php

namespace Adapter\example01;

class Duck implements DuckInterface
{
    public function quack()
    {
        echo 'Кря кря'.PHP_EOL;
    }

    public function fly()
    {
        echo 'А я летаю далеко'.PHP_EOL;
    }
}