<?php

namespace Command\example01\Command;

use Command\example01\CommandInterface;
use Command\example01\Entity\Stereo;

class StereoOnWithCDCommand implements CommandInterface
{
    private Stereo $stereo;

    public function __construct($stereo)
    {
        $this->stereo = $stereo;
    }

    public function execute()
    {
        $this->stereo->on();
        $this->stereo->setCd();
        $this->stereo->setVolume(42);
    }

    public function undo()
    {
        $this->stereo->off();
    }
}