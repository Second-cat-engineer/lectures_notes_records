<?php

namespace lesson04\example01\demo07\cart\storage;

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
