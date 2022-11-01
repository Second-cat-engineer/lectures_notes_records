<?php

namespace lesson02\src\Models;

/**
 * @property int $code
 * @property string $number
 */
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