<?php

namespace State\example01\State;

use State\example01\GumballMachine;
use State\example01\StateInterface;

class NoQuarterState implements StateInterface
{
    protected GumballMachine $gumballMachine;

    public function __construct($gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter()
    {
        echo 'Вы внесли монету!'.PHP_EOL;
        $this->gumballMachine->setState($this->gumballMachine->getHasQuarterState());
    }

    public function ejectQuarter()
    {
        echo 'Вы не внесли монету!'.PHP_EOL;
    }

    public function turnCrank()
    {
        echo 'Вы повернули ручку, сначала необходимо внести монету!'.PHP_EOL;
    }

    public function dispense()
    {
        echo 'Сначала необходимо внести монету!'.PHP_EOL;
    }
}