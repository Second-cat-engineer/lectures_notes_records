<?php

namespace app\listeners\interview;

use app\events\interview\InterviewRejectEvent;
use app\services\NotifierInterface;

class InterviewRejectListener
{
    private NotifierInterface $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    public function handle(InterviewRejectEvent $event): void
    {
        $this->notifier->notify(
            $event->interview->email,
            'interview/reject',
            ['model' => $event->interview],
            'Your interview is rejected'
        );
    }
}