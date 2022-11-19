<?php

namespace app\listeners\interview;

use app\events\interview\InterviewJoinEvent;
use app\services\NotifierInterface;

class InterviewJoinListener
{
    private NotifierInterface $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    public function handle(InterviewJoinEvent $event): void
    {
        $this->notifier->notify(
            $event->interview->email,
            'interview/join',
            ['model' => $event->interview],
            'You are joined to interview!'
        );
    }
}