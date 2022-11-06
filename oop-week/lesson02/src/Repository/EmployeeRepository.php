<?php

namespace lesson02\src\Repository;

use lesson02\src\Models\Address;
use lesson02\src\Collections\PhoneCollection;
use lesson02\src\Entity\Employee;
use lesson02\src\Helpers\IdGenerator;
use lesson02\src\Models\Name;
use lesson02\src\Models\Phone;

class EmployeeRepository
{
    public function find($id): ?Employee
    {
        // Заглушка
        return new Employee(
            (new IdGenerator())->nextId(),
            new Name('Safuan', 'Yaylyaev'),
            new PhoneCollection([new Phone(7, '1234567890')]),
            new Address('Russia', 'Moscow', 'Moscow', 'tests', 1)
        );
    }

    public function save(Employee $employee): bool
    {
        // ....
        return true;
    }
}