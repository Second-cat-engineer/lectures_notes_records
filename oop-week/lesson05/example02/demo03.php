<?php

class Player
{
    private $volume = 5;
    public $track;
    public $state;

    public function play()
    {

    }

    public function stop()
    {

    }

    public function prev()
    {

    }

    public function next()
    {

    }

    public function getVolume()
    {
        return $this->volume;
    }

    public function setVolume($volume)
    {
        if (0 <= $volume &&  $volume <= 10) {
            $this->volume = $volume;
        }
    }
}

$player = new Player();
$player->play();