<?php

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

    /** @var Disc */
    private $disc;

    private $track;
    private int $volume = 5;
    private $state;

    public function insert(Disc $disc)
    {
        $this->disc = $disc;
    }

    public function play()
    {
        if (empty($this->disc)) {
            throw new \RuntimeException('Вставьте диск');
        }

        if ($this->disc->getTracksCount() == 0) {
            throw new \RuntimeException('Диск пуст');
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
            throw new \LogicException('Последний трек');
        }
    }

    public function getVolume()
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
    $player->play();
} catch (\RuntimeException $e) {
    echo 'Ошибка плеера: ' . $e->getMessage();
} catch (\LogicException $e) {
    echo 'Ошибка логики: ' . $e->getMessage();
} catch (\Exception $e) {
    echo 'Другая ошибка: ' . $e->getMessage();
}
