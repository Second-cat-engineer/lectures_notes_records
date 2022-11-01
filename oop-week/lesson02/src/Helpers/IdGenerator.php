<?php

namespace lesson02\src\Helpers;

class IdGenerator
{
    public function nextId(): int
    {
        return rand(10000, 99999);
    }
}