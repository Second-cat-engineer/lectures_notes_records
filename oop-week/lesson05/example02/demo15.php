<?php

class DiscException extends \RuntimeException
{
}

class Event
{
    /** @var Player */
    public $sender;

    public function __construct($sender)
    {
        $this->sender = $sender;
    }
}

class PlayStartEvent extends Event
{
    public $track;

    public function __construct(Player $sender, $track)
    {
        $this->track = $track;
        parent::__construct($sender);
    }
}

class Disc
{
    private $tracks = [];

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

    public function getTracksCount()
    {
        return count($this->tracks);
    }
}

class Player
{
    const STATE_STOP = 0;
    const STATE_PLAY = 1;

    const EVENT_PLAY_START = 'playStart';
    const EVENT_DISC_COMPLETE = 'discComplete';

    private $listeners = [];

    /** @var Disc */
    private $disc;

    private $currentTrack;
    private $track;
    private $volume = 5;
    private $state;

    public function on($name, $callback)
    {
        $this->listeners[$name][] = $callback;
    }

    public function off($name, $callback)
    {
        if (isset($this->listeners[$name])) {
            foreach ($this->listeners[$name] as $i => $listener) {
                if ($listener === $callback) {
                    unset($this->listeners[$name][$i]);
                };
            }
        }
    }

    private function trigger($name, Event $event)
    {
        if (isset($this->listeners[$name])) {
            foreach ($this->listeners[$name] as $listener) {
                call_user_func($listener, $event);
            }
        }
    }

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
        $this->trigger(self::EVENT_PLAY_START, new PlayStartEvent($this, $this->track));
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
        if ($newTrack <= $this->disc->getTracksCount()) {
            $this->changeTrack($newTrack);
        } else {
            $this->trigger(self::EVENT_DISC_COMPLETE, new Event($this));
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
$player->insert(new Disc(['Track `', 'Track 2', 'Track 3']));

$player->on(Player::EVENT_PLAY_START, function (PlayStartEvent $event) {
    echo 'Начало воспроизведения' . PHP_EOL;
});
$player->on(Player::EVENT_PLAY_START, function (PlayStartEvent $event) {
    echo '#' . $event->track . ': ' . $event->sender->getCurrentTrack() . PHP_EOL;
});

$player->on(Player::EVENT_DISC_COMPLETE, function (Event $event) {
    echo 'Диск завершён' . PHP_EOL;
});

$player->play();
$player->next();
$player->next();
$player->next();
$player->next();
$player->next();
$player->next();
$player->prev();

