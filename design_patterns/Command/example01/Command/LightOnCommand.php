<?php

namespace Command\example01\Command;

use Command\example01\CommandInterface;
use Command\example01\Entity\Light;

class LightOnCommand implements CommandInterface
{
    private Light $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->on();
    }

    public function undo()
    {
        $this->light->off();
    }
}