<?php

namespace app\events\employee;

use app\events\Event;
use app\events\LoggedEvent;
use app\models\Employee;

class EmployeeRecruitEvent extends Event implements LoggedEvent
{
    public Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getLogMessage(): string
    {
        return 'Employee ' . $this->employee->id . ' is recruit';
    }
}