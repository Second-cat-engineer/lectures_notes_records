<?php
class Name
{
    public string $first;
    public string $last;

    public function __construct(string $first, string $last)
    {
        $this->first = $first;
        $this->last = $last;
    }

    public function getFull(): string
    {
        return $this->last . ' ' . $this->first;
    }
}

class Phone
{
    public int $code;
    public string $number;

    public function __construct(int $code, string $number)
    {
        $this->code = $code;
        $this->number = $number;
    }

    public function isEqualTo(Phone $phone): bool
    {
        return $this->code === $phone->code && $this->number === $phone->number;
    }
}

class Address
{
    public string $country;
    public string $region;
    public string $city;
    public string $street;
    public string $house;

    public function __construct($country, $region, $city, $street, $house)
    {
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
    }
}


class Employee
{
    private int $id;
    private Name $name;
    private array $phones; // private array $phones = [];
    private Address $address;

    public function __construct(int $id, Name $name, array $phones, Address $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phones[] = $phones;
        $this->address = $address;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getPhones(): array
    {
        return $this->phones;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function rename(Name $name)
    {
        $this->name = $name;
    }

    public function addPhone(Phone $phone)
    {
        foreach ($this->phones as $item) {
            if ($item->isEqualTo($phone)) {
                 throw new Exception('Phone already exist.');
            }

            $this->phones[] = $phone;
        }
    }

    public function removePhone(Phone $phone)
    {
        foreach ($this->phones as $i => $item) {
            if ($item->isEqualTo($phone)) {
                unset($this->phones[$i]);
                return;
            }
        }
        throw new Exception('Phone not found.');
    }


    public function changeAddress(Address $address)
    {
        $this->address = $address;
    }
}

//==============================================================================================
class StaffService
{
    public function recruitEmployee(Name $name, Phone $phone, Address $address)
    {
        $employee = new Employee($this->generateId(), $name, [$phone], $address);

        $this->save($employee);

        return $employee;
    }

    public function changeEmployeePhone($id, Phone $phone)
    {
        $employee = $this->find($id);
        $employee->addPhone($phone);
        $this->save($employee);
    }

    private function generateId(): int
    {
        return rand(1000, 999999);
    }

    private function save(Employee $employee)
    {
        // ....
    }

    private function find(int $id): ?Employee
    {
        return null;
    }
}

//=========================================================================
$service = new StaffService();
$employee = $service->recruitEmployee(
    new Name('Safuan', 'Yaylyaev'),
    new Phone(7, '1234567890'),
    new Address('Russia', 'Moscow', 'Moscow', 'tests', 1)
);
echo $employee->getName()->getFull();

//=========================================================================
//$service->changeEmployeePhone(5, new Phone(7, '0987654321'));