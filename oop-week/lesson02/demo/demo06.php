<?php


namespace lesson02\example3\demo20;

##############################

class Name
{
    public $first;
    public $last;

    public function __construct($first, $last)
    {
        $this->first = $first;
        $this->last = $last;
    }

    public function getFull()
    {
        return $this->last . ' ' . $this->first;
    }
}

class Phone
{
    public $code;
    public $number;

    public function __construct($code, $number)
    {
        $this->code = $code;
        $this->number = $number;
    }

    public function isEqualTo(Phone $phone)
    {
        return $this->code == $phone->code && $this->number == $phone->number;
    }
}

class PhonesCollection
{
    private $phones;

    public function __construct(array $phones)
    {
        foreach ($phones as $phone) {
            if (!$phone instanceof Phone) {
                throw new \InvalidArgumentException('Incorrect phone.');
            }
        }
        $this->phones = $phones;
    }

    public function add(Phone $phone)
    {
        foreach ($this->phones as $item) {
            if ($item->isEqualTo($phone)) {
                throw new \Exception('Phone already exists.');
            }
        }
        $this->phones[] = $phone;
    }

    public function remove(Phone $phone)
    {
        foreach ($this->phones as $i => $item) {
            if ($item->isEqualTo($phone)) {
                unset($this->phones[$i]);
                return;
            }
        }
        throw new \Exception('Phone not found.');
    }

    public function getAll()
    {
        return $this->phones;
    }
}

class Address
{
    public $country;
    public $region;
    public $city;
    public $street;
    public $house;

    public function __construct($country, $region, $city, $street, $house)
    {
    }
}

class Employee
{
    private $id;
    private $name;
    private $phones;
    private $address;

    public function __construct($id, Name $name, PhonesCollection $phones, Address $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phones = $phones;
        $this->address = $address;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhones()
    {
        return $this->phones->getAll();
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function rename(Name $name)
    {
        $this->name = $name;
    }

    public function addPhone(Phone $phone)
    {
        $this->phones->add($phone);
    }

    public function removePhone(Phone $phone)
    {
        $this->phones->remove($phone);
    }

    public function changeAddress(Address $address)
    {
        $this->address = $address;
    }
}

##############################

class IdGenerator
{
    public function nextId()
    {
        return rand(10000, 99999);
    }
}

class EmployeeRepository
{
    public function find($id)
    {
        return null;
    }

    public function save(Employee $employee)
    {
    }
}

class StaffService
{
    private $employeeRepository;
    private $idGenerator;

    public function __construct(EmployeeRepository $employeeRepository, IdGenerator $idGenerator)
    {
        $this->employeeRepository = $employeeRepository;
        $this->idGenerator = $idGenerator;
    }

    public function recruitEmployee(Name $name, Phone $phone, Address $address)
    {
        $employee = new Employee($this->idGenerator->nextId(), $name, new PhonesCollection([$phone]), $address);
        $this->employeeRepository->save($employee);
        return $employee;
    }

    public function addEmployeePhone($id, Phone $phone)
    {
        $employee = $this->employeeRepository->find($id);
        $employee->addPhone($phone);
        $this->employeeRepository->save($employee);
    }

    public function removeEmployeePhone($id, Phone $phone)
    {
        $employee = $this->employeeRepository->find($id);
        $employee->removePhone($phone);
        $this->employeeRepository->save($employee);
    }
}

##############################

$service = new StaffService(new EmployeeRepository(), new IdGenerator());

$employee = $service->recruitEmployee(
    new Name('Вася', 'Пупкин'),
    new Phone(7, '92000000000'),
    new Address('Россия', 'Липецкая обл.', 'г. Пушкин', 'ул. Ленина', 1)
);

echo $employee->getName()->getFull() . PHP_EOL;

$service->addEmployeePhone(5, new Phone(7, '910000000000'));

