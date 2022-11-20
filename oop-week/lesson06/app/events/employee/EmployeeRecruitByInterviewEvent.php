<?php

namespace app\events\employee;

use app\events\Event;
use app\events\LoggedEvent;
use app\models\Employee;
use app\models\Interview;

class EmployeeRecruitByInterviewEvent extends Event implements LoggedEvent
{
    public Employee $employee;
    public Interview $interview;

    public function __construct(Employee $employee, Interview $interview)
    {
        $this->employee = $employee;
        $this->interview = $interview;
    }

    public function getLogMessage(): string
    {
        return 'Employee ' . $this->employee->id . ' is recruit by interview ' . $this->interview->id;
    }
}