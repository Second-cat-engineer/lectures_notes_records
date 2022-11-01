<?php

namespace lesson02\src\Collections;

use Exception;
use lesson02\src\Models\Phone;

class PhoneCollection
{
    private array $phones;

    public function __construct(array $phones)
    {
        foreach ($phones as $phone) {
            if (!$phone instanceof Phone) {
                throw new \InvalidArgumentException('Incorrect phone.');
            }
        }

        $this->phones = $phones;
    }

    /**
     * @throws Exception
     */
    public function add(Phone $phone): bool
    {
        foreach ($this->phones as $item) {
            if ($item->isEqualTo($phone)) {
                throw new Exception('Phone already exists.');
            }
        }
        $this->phones[] = $phone;

        return true;
    }

    /**
     * @throws Exception
     */
    public function remove(Phone $phone): bool
    {
        foreach ($this->phones as $i => $item) {
            if ($item->isEqualTo($phone)) {
                unset($this->phones[$i]);

                return true;
            }
        }
        throw new Exception('Phone not found.');
    }

    public function getAll(): array
    {
        return $this->phones;
    }
}