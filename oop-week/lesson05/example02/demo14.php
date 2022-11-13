<?php

class DiscException extends \RuntimeException
{
}

class Disc
{
    private array $tracks = [];

    public function __construct(array $tracks)
    {
        $this->tracks = $tracks;
    }

    public function getTrack($id)
    {
        if (!isset($this->tracks[$id - 1])) {
            throw new \OutOfBoundsException('Трек не найден');
        }
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

    public $onPlayStart;
    public $onDiscComplete;

    /** @var Disc */
    private $disc;

    private $currentTrack;
    private $track;
    private $volume = 5;
    private $state;

    public function insert(Disc $disc)
    {
        $this->disc = $disc;
    }

    public function play()
    {
        if (empty($this->disc)) {
            throw new DiscException('Вставьте диск');
        }

        if ($this->disc->getTracksCount() == 0) {
            throw new DiscException('Диск пуст');
        }

        if (empty($this->track)) {
            $this->track = 1;
        }
        $this->currentTrack = $this->disc->getTrack($this->track);
        $this->state = self::STATE_PLAY;
        if ($this->onPlayStart) {
            call_user_func($this->onPlayStart, $this);
        }
    }

    public function stop()
    {
        $this->state = self::STATE_STOP;
    }

    public function prev()
    {
        $newTrack = $this->track - 1;
        if ($newTrack < 1) {
            throw new \LogicException('Первый трек');
        }
        $this->changeTrack($newTrack);
    }

    public function next()
    {
        $newTrack = $this->track + 1;
        if ($newTrack < $this->disc->getTracksCount()) {
            $this->changeTrack($newTrack);
        } else {
            if ($this->onDiscComplete) {
                call_user_func($this->onDiscComplete, $this);
            }
        }
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume($volume)
    {
        if (!(0 <= $volume &&  $volume <= 10)) {
            throw new \OutOfBoundsException('Громкость вне диапазона');
        }
        $this->volume = $volume;
    }

    public function getCurrentTrack()
    {
        return $this->currentTrack;
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

$player->onPlayStart = function (Player $player) {
    echo 'Трек: ' . $player->getCurrentTrack() . PHP_EOL;
};

$player->onDiscComplete = function (Player $player) {
    echo 'Диск завершён' . PHP_EOL;
};

$player->play();
$player->next();
$player->next();
$player->next();
$player->next();
$player->prev();

