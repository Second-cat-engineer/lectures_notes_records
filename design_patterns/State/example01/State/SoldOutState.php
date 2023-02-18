<?php

namespace State\example01\State;

use State\example01\GumballMachine;
use State\example01\StateInterface;

class SoldOutState implements StateInterface
{
    protected GumballMachine $gumballMachine;

    public function __construct($gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter()
    {
        echo 'Сорян, жвачки закончились.'.PHP_EOL;
    }

    public function ejectQuarter()
    {
        echo 'Нельзя выдать то что не внесено'.PHP_EOL;
    }

    public function turnCrank()
    {
        echo 'Сорян, жвачки закончились.'.PHP_EOL;
    }

    public function dispense()
    {
        echo 'Сорян, жвачки закончились.'.PHP_EOL;
    }
}