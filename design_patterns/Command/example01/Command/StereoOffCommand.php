<?php

namespace Command\example01\Command;

use Command\example01\CommandInterface;
use Command\example01\Entity\Stereo;

class StereoOffCommand implements CommandInterface
{
    private Stereo $stereo;

    public function __construct($stereo)
    {
        $this->stereo = $stereo;
    }

    public function execute()
    {
        $this->stereo->off();
    }

    public function undo()
    {
        $this->stereo->on();
    }
}