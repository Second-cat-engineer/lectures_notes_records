<?php

class Disc
{
    private $tracks = [];

    public function __construct(array $tracks)
    {
        $this->tracks = $tracks;
    }

    public function getTrack($id)
    {
        return $this->tracks[$id - 1];
    }

    public function getTracksCount(): int
    {
        return count($this->tracks);
    }
}

class Player
{
    const STATE_STOP = 0;
    const STATE_PLAY = 1;

    /** @var Disc */
    private $disc;

    private $track;
    private $volume = 5;
    private $state;

    public function insert(Disc $disc)
    {
        $this->disc = $disc;
    }

    public function play()
    {
        if (empty($this->track)) {
            $this->track = 1;
        }
        $this->state = self::STATE_PLAY;
        echo $this->disc->getTrack($this->track) . PHP_EOL;
    }

    public function stop()
    {
        $this->state = self::STATE_STOP;
    }

    public function prev()
    {
        $newTrack = $this->track - 1;
        if ($newTrack > 0) {
            $this->changeTrack($newTrack);
        }
    }

    public function next()
    {
        $newTrack = $this->track + 1;
        if ($newTrack <= $this->disc->getTracksCount()) {
            $this->changeTrack($newTrack);
        }
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

    private function changeTrack($newTrack)
    {
        if ($this->state === self::STATE_PLAY) {
            $this->stop();
            $this->track = $newTrack;
            $this->play();
        } else {
            $this->track = $newTrack;
        }
    }
}

$player = new Player();
$player->insert(new Disc(['Track 1', 'Track 2', 'Track 3']));
$player->play();
$player->next();
$player->stop();
$player->prev();
$player->play();