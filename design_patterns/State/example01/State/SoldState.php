<?php

namespace State\example01\State;

use State\example01\GumballMachine;
use State\example01\StateInterface;

class SoldState implements StateInterface
{
    protected GumballMachine $gumballMachine;

    public function __construct($gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter()
    {
        echo 'Жди! мы ва уже дали жевательную резинку'.PHP_EOL;
    }

    public function ejectQuarter()
    {
        echo 'Неа, не верну монету! Вы уже прокрутил ручку'.PHP_EOL;
    }

    public function turnCrank()
    {
        echo 'Прокрути хоть тыщу раз! Вы все равно не получите еще одну жевательную резинку'.PHP_EOL;
    }

    public function dispense()
    {
        $this->gumballMachine->releaseBall();
        if ($this->gumballMachine->getCount() > 0) {
            $this->gumballMachine->setState($this->gumballMachine->getNoQuarterState());
        } else {
            echo 'Сорян, жвачки закончились.'.PHP_EOL;
            $this->gumballMachine->setState($this->gumballMachine->getSoldOutState());
        }
    }
}