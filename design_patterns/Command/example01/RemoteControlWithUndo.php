<?php

namespace Command\example01;

use Command\example01\Command\NoCommand;

class RemoteControlWithUndo
{
    /** @var CommandInterface[]  */
    private array $onCommands = [];
    /** @var CommandInterface[]  */
    private array $offCommands = [];

    private CommandInterface $undoCommand;

    public function __construct()
    {
        $noCommand = new NoCommand();

        for ($i = 0; $i < 7; $i++) {
            $this->onCommands[$i] = $noCommand;
            $this->offCommands[$i] = $noCommand;
        }

        $this->undoCommand = $noCommand;
    }

    public function setCommand(int $slot, CommandInterface $onCommand, CommandInterface $offCommand)
    {
        $this->onCommands[$slot] = $onCommand;
        $this->offCommands[$slot] = $offCommand;
    }

    public function onButtonWasPushed(int $slot)
    {
        $this->onCommands[$slot]->execute();
        $this->undoCommand = $this->onCommands[$slot];
    }

    public function offButtonWasPushed(int $slot)
    {
        $this->offCommands[$slot]->execute();
        $this->undoCommand = $this->offCommands[$slot];
    }

    public function undoButtonWasPushed()
    {
        $this->undoCommand->undo();
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