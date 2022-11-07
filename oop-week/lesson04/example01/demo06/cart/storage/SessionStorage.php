<?php

namespace lesson04\example01\demo06\cart\storage;

use lesson04\example01\demo06\cart\StorageInterface;

class SessionStorage implements StorageInterface
{
    private string $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function load()
    {
        return isset($_SESSION[$this->key]) ? unserialize($_SESSION[$this->key]) : [];
    }

    public function save(array $items)
    {
        $_SESSION[$this->key] = serialize($items);
    }
}
