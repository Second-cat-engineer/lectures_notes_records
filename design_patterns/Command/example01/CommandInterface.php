<?php

namespace Command\example01;

interface CommandInterface
{
    public function execute();

    public function undo();
}