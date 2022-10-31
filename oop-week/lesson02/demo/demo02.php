<?php

class Student
{
    const TYPE_OCHN = 1;
    const TYPE_ZAOCHN = 2;

    private $name;
    private $type;

    private function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public static function createOchn($name)
    {
        return new self($name, self::TYPE_OCHN);
    }

    public static function createZaochn($name)
    {
        return new self($name, self::TYPE_ZAOCHN);
    }

    public function getName()
    {
        return $this->name;
    }

    public function isOchn()
    {
        return $this->type === self::TYPE_OCHN;
    }

    public function isZaochn()
    {
        return $this->type === self::TYPE_ZAOCHN;
    }
}

$student1 = Student::createOchn('Vasya Ivanov');
$student2 = Student::createZaochn('Petya Sidorov');

echo $student1->getName() . PHP_EOL;
echo $student2->getName() . PHP_EOL;