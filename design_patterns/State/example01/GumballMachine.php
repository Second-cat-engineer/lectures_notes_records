<?php

namespace State\example01;

use State\example01\State\HasQuarterState;
use State\example01\State\NoQuarterState;
use State\example01\State\SoldOutState;
use State\example01\State\SoldState;
use State\example01\State\WinnerState;

class GumballMachine
{
    protected StateInterface $soldOutState;
    protected StateInterface $noQuarterState;
    protected StateInterface $hasQuarterState;
    protected StateInterface $soldState;
    protected StateInterface $winnerState;

    protected StateInterface $state;
    protected int $count = 0;

    public function __construct(int $numberGumballs)
    {
        $this->soldOutState = new SoldOutState($this);
        $this->noQuarterState = new NoQuarterState($this);
        $this->hasQuarterState = new HasQuarterState($this);
        $this->soldState = new SoldState($this);
        $this->winnerState = new WinnerState($this);

        $this->count = $numberGumballs;
        if ($numberGumballs > 0) {
            $this->state = $this->noQuarterState;
        } else {
            $this->state = $this->soldState;
        }
    }

    public function insertQuarter()
    {
        $this->state->insertQuarter();
    }

    public function ejectQuarter()
    {
        $this->state->ejectQuarter();
    }

    public function turnCrank()
    {
        $this->state->turnCrank();
        $this->state->dispense();
    }

    public function setState(StateInterface $state)
    {
        $this->state = $state;
    }

    public function releaseBall()
    {
        echo 'Жевательная резинка выкатывается....' . PHP_EOL;
        if ($this->count !== 0) {
            $this->count--;
        }
    }

    public function getHasQuarterState()
    {
        return $this->hasQuarterState;
    }

    public function getNoQuarterState()
    {
        return $this->noQuarterState;
    }

    public function getSoldOutState()
    {
        return $this->soldOutState;
    }

    public function getSoldState()
    {
        return $this->soldState;
    }

    public function getWinnerState()
    {
        return $this->winnerState;
    }

    public function getCount()
    {
        return $this->count;
    }
}