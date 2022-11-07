<?php

namespace lesson04\example01\demo07\cart\storage;

use lesson04\example01\demo07\cart\CartItem;

interface StorageInterface
{
    /**
     * @return CartItem[]
     */
    public function load();

    /**
     * @param CartItem[] $items
     */
    public function save(array $items);
}
