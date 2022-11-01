<?php
require __DIR__ . '/../../autoload.php';

use lesson02\src\Helpers\IdGenerator;
use lesson02\src\Repository\EmployeeRepository;
use lesson02\src\Models\Name;
use lesson02\src\Models\Phone;
use lesson02\src\Models\Address;

$service = new \lesson02\src\Service\StaffService(new EmployeeRepository(), new IdGenerator());
$employee = $service->recruitEmployee(
    new Name('Вася', 'Пупкин'),
    new Phone(7, '92000000000'),
    new Address('Россия', 'Липецкая обл.', 'г. Пушкин', 'ул. Ленина', 1)
);

echo $employee->getName()->getFull() . PHP_EOL;

//print_r($employee);