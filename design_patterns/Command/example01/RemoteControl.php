<?php

namespace Command\example01;

use Command\example01\Command\NoCommand;

class RemoteControl
{
    /** @var CommandInterface[]  */
    private array $onCommands = [];
    /** @var CommandInterface[]  */
    private array $offCommands = [];

    public function __construct()
    {
        $noCommand = new NoCommand();

        for ($i = 0; $i < 7; $i++) {
            $this->onCommands[$i] = $noCommand;
            $this->offCommands[$i] = $noCommand;
        }
    }

    public function setCommand(int $slot, CommandInterface $onCommand, CommandInterface $offCommand)
    {
        $this->onCommands[$slot] = $onCommand;
        $this->offCommands[$slot] = $offCommand;
    }

    public function onButtonWasPushed(int $slot)
    {
        $this->onCommands[$slot]->execute();
    }

    public function offButtonWasPushed(int $slot)
    {
        $this->offCommands[$slot]->execute();
    }

    public function toStrong()
    {
        $res = '---RemoteControl---'.PHP_EOL;

        for ($i = 0; $i < 7; $i++) {
            $res .= '[slot'.$i.'] '.get_class($this->onCommands[$i]).' '.get_class($this->offCommands[$i]).PHP_EOL;
        }

        return $res;
    }
}