<?php

namespace app\listeners\employee;

use app\events\employee\EmployeeRecruitEvent;
use app\services\NotifierInterface;

class EmployeeRecruitListener
{
    private NotifierInterface $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    public function handle(EmployeeRecruitEvent $event): void
    {
        $this->notifier->notify(
            'employee/probation',
            ['model' => $event->employee],
            $event->employee->email,
            'You are recruit!'
        );
    }
}