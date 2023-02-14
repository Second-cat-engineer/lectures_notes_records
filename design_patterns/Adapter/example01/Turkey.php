<?php

namespace Adapter\example01;

class Turkey implements TurkeyInterface
{
    public function gobble()
    {
        echo 'гбл гбл блеять'.PHP_EOL;
    }

    public function fly()
    {
        echo 'Я летаю недалеко'.PHP_EOL;
    }
}