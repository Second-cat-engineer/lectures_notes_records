<?php

namespace lesson02\src\Entity;

use lesson02\src\Models\Address;
use lesson02\src\Collections\PhoneCollection;
use lesson02\src\Models\Name;
use lesson02\src\Models\Phone;

class Employee
{
    private int $id;
    private Name $name;
    private PhoneCollection $phones;
    private Address $address;

    public function __construct(int $id, Name $name, PhoneCollection $phones, Address $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phones = $phones;
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

    public function getPhones(): PhoneCollection
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

    public function changeAddress(Address $address)
    {
        $this->address = $address;
    }

    public function addPhone(Phone $phone)
    {
        $this->phones->add($phone);
    }

    public function removePhone(Phone $phone)
    {
        $this->phones->remove($phone);
    }
}