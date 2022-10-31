<?php

class Student
{
    private $firstName;
    private $lastName;
    private $birthDate;

    public function __construct($firstName, $lastName, $birthDate)
    {
        if (empty($firstName) || empty($lastName) || empty($birthDate)) {
            throw new InvalidArgumentException('Некорректные данные');
        }

        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthDate = $birthDate;
    }

    public function rename($firstName, $lastName)
    {
        if (empty($firstName) || empty($lastName)) {
            throw new InvalidArgumentException('Введите имя и фамилию');
        }

        $this->lastName = $lastName;
        $this->firstName = $firstName;
    }

    public function getFullName()
    {
        return $this->lastName . ' ' . $this->firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getAge()
    {
        return '';
    }
}

$student = new Student('Petya', 'Ivanov', '1995-08-26');
echo $student->getFullName() . PHP_EOL;

$student->rename('Vasya', 'Pupkin');
echo $student->getFullName() . PHP_EOL;