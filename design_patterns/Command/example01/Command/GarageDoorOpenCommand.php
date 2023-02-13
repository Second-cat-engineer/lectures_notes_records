<?php

namespace Command\example01\Command;

use Command\example01\CommandInterface;
use Command\example01\Entity\GarageDoor;

class GarageDoorOpenCommand implements CommandInterface
{
    private GarageDoor $garageDoor;

    public function __construct(GarageDoor $garageDoor)
    {
        $this->garageDoor = $garageDoor;
    }

    public function execute()
    {
        $this->garageDoor->up();
    }

    public function undo()
    {
        $this->garageDoor->down();
    }
}