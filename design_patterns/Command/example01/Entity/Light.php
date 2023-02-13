<?php

namespace Command\example01\Entity;

class Light
{
    public function on()
    {
        echo 'Light is on' . PHP_EOL;
    }

    public function off()
    {
        echo 'Light is off' . PHP_EOL;
    }
}