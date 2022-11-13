<?php

class Disc
{
    private array $tracks = [];

    public function __construct(array $tracks)
    {
        $this->tracks = $tracks;
    }

    /**
     * @throws Exception
     */
    public function getTrack($id)
    {
        if (!isset($this->tracks[$id - 1])) {
            throw new Exception('Трек не найден');
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

    /** @var Disc */
    private $disc;

    private $track;
    private $volume = 5;
    private $state;

    public function insert(Disc $disc)
    {
        $this->disc = $disc;
    }

    /**
     * @throws Exception
     */
    public function play()
    {
        if (empty($this->disc)) {
            throw new Exception('Вставьте диск');
        }

        if ($this->disc->getTracksCount() == 0) {
            throw new Exception('Диск пуст');
        }

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
        if ($newTrack < $this->disc->getTracksCount()) {
            $this->changeTrack($newTrack);
        }
    }

    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @throws Exception
     */
    public function setVolume($volume)
    {
        if (!(0 <= $volume && $volume <= 10)) {
            throw new Exception('Громкость вне диапазона');
        }
        $this->volume = $volume;
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

try {
//    $player->setVolume(12);
    $player->play();
} catch (Exception $e) {
    echo 'Ошибка: ' . $e->getMessage() . PHP_EOL;
}
