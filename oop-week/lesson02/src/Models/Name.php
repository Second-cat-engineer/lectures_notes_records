<?php

namespace lesson02\src\Models;

/**
 * @property string $first
 * @property string $last
 */
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