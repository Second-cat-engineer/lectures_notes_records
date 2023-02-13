<?php

namespace Command\example01;

class SimpleRemoteControl
{
    private CommandInterface $slot;

    public function setCommand(CommandInterface $command)
    {
        $this->slot = $command;
    }

    public function buttonWasPressed()
    {
        $this->slot->execute();
    }
}