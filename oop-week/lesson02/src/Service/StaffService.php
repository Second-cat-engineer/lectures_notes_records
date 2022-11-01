<?php

namespace lesson02\src\Service;

use Exception;
use lesson02\src\Models\Address;
use lesson02\src\Collections\PhoneCollection;
use lesson02\src\Entity\Employee;
use lesson02\src\Helpers\IdGenerator;
use lesson02\src\Models\Name;
use lesson02\src\Models\Phone;
use lesson02\src\Repository\EmployeeRepository;

class StaffService
{
    protected EmployeeRepository $employeeRepository;
    protected IdGenerator $idGenerator;

    public function __construct(EmployeeRepository $employeeRepository, IdGenerator $idGenerator)
    {
        $this->employeeRepository = $employeeRepository;
        $this->idGenerator = $idGenerator;
    }

    /**
     * @throws Exception
     */
    public function recruitEmployee(Name $name, Phone $phone, Address $address): Employee
    {
        $employee = new Employee($this->idGenerator->nextId(), $name, new PhoneCollection([$phone]), $address);
        if (!$this->employeeRepository->save($employee)) {
            throw new Exception('Failed save.');
        }

        return $employee;
    }

    /**
     * @throws Exception
     */
    public function addEmployeePhone($id, Phone $phone): Employee
    {
        $employee = $this->employeeRepository->find($id);
        if (!$employee) {
            throw new Exception('Employee not found.');
        }

        $employee->addPhone($phone);
        if (!$this->employeeRepository->save($employee)) {
            throw new Exception('Failed save.');
        }

        return $employee;
    }
}