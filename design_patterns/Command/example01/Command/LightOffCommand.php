<?php

namespace Command\example01\Command;

use Command\example01\CommandInterface;
use Command\example01\Entity\Light;

class LightOffCommand implements CommandInterface
{
    private Light $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->off();
    }

    public function undo()
    {
        $this->light->on();
    }
}