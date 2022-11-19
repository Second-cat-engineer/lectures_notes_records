<?php

namespace app\listeners\interview;

use app\events\interview\InterviewMoveEvent;
use app\services\NotifierInterface;

class InterviewMoveListener
{
    private NotifierInterface $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    public function handle(InterviewMoveEvent $event): void
    {
        $this->notifier->notify(
            $event->interview->email,
            'interview/move',
            ['model' => $event->interview],
            'Your interview is moved'
        );
    }
}