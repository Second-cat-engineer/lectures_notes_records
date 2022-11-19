<?php

namespace app\events\interview;

use app\events\Event;
use app\models\Interview;

class InterviewEditEvent extends Event
{
    public Interview $interview;

    public function __construct(Interview $interview)
    {
        $this->interview = $interview;
    }
}