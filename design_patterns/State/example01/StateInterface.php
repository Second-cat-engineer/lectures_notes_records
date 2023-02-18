<?php

namespace State\example01;

interface StateInterface
{
    public function insertQuarter();
    public function ejectQuarter();
    public function turnCrank();
    public function dispense();
}