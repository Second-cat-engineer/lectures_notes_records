<?php

namespace app\events\interview;

use app\events\Event;
use app\events\LoggedEvent;
use app\models\Interview;

class InterviewJoinEvent extends Event implements LoggedEvent
{
    public Interview $interview;

    public function __construct(Interview $interview)
    {
        $this->interview = $interview;
    }

    public function getLogMessage(): string
    {
        return $this->interview->last_name . ' ' . $this->interview->first_name . ' is joined to interview';
    }
}