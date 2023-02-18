<?php

namespace State\example01\State;

use State\example01\GumballMachine;
use State\example01\StateInterface;

class HasQuarterState implements StateInterface
{
    protected GumballMachine $gumballMachine;

    public function __construct($gumballMachine)
    {
        $this->gumballMachine = $gumballMachine;
    }

    public function insertQuarter()
    {
        echo 'Вы уже внесли монету!'.PHP_EOL;
    }

    public function ejectQuarter()
    {
        echo 'Монета возвращена!'.PHP_EOL;
        // После возвращения монеты автомат переходит в состояние NoQuarterState
        $this->gumballMachine->setState($this->gumballMachine->getNoQuarterState());
    }

    public function turnCrank()
    {
        echo 'Вы повернули ручку...'.PHP_EOL;
        if (random_int(1, 100) > 90 && $this->gumballMachine->getCount() > 1) {
            $this->gumballMachine->setState($this->gumballMachine->getWinnerState());

        } else {
            // Когда покупатель дергает за рычаг, автомат переводится в состояние soldState
            $this->gumballMachine->setState($this->gumballMachine->getSoldState());
        }
    }

    public function dispense()
    {
        echo 'Нет жевательной резинки!'.PHP_EOL;
    }
}