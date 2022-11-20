<?php

namespace app\services\dto;

class RecruitData
{
    public $firstName;
    public $lastName;
    public $address;
    public $email;

    public function __construct($firstName, $lastName, $address, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->email = $email;
    }
}