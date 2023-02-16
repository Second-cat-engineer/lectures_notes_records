<?php

namespace Iterator\example01\Iterator;

use Iterator\example01\IteratorInterface;

class PancakeHouseMenuIterator implements IteratorInterface
{
    protected array $items = [];
    protected int $position = 0;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function next()
    {
        $item = $this->items[$this->position];
        $this->position++;
        return $item;
    }

    public function hasNext(): bool
    {
        if ($this->position >= count($this->items)) {
            return false;
        }

        return true;
    }
}