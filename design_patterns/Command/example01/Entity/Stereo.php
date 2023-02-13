<?php

namespace Command\example01\Entity;

class Stereo
{
    public function on()
    {
        echo 'Stereo on'.PHP_EOL;
    }

    public function off()
    {
        echo 'Stereo off'.PHP_EOL;
    }

    public function setCd()
    {
        echo 'Stereo set CD'.PHP_EOL;
    }

    public function setDvd()
    {
        echo 'Stereo set DVD'.PHP_EOL;
    }

    public function setRadio()
    {
        echo 'Stereo set Radio'.PHP_EOL;
    }

    public function setVolume($volume)
    {
        echo 'Stereo set volume: '.$volume.PHP_EOL;
    }
}