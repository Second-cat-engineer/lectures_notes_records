<?php

class Player
{
    const STATE_STOP = 0;
    const STATE_PLAY = 1;

    private $track;
    private $volume = 5;
    private $state;

    public function play()
    {
        if (empty($this->track)) {
            $this->track = 1;
        }
        $this->state = self::STATE_PLAY;
    }

    public function stop()
    {
        $this->state = self::STATE_STOP;
    }

    public function prev()
    {
        $this->stop();
        $this->track--;
        $this->play();
    }

    public function next()
    {
        $this->stop();
        $this->track++;
        $this->play();
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