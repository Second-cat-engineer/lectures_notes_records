<?php

namespace Singleton;

class Singleton
{
    private static $instance;
    private array $props = [];

    static public function getInstance()
    {
        if (empty(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public function setProperty(string $key, string $value)
    {
        $this->props[$key] = $value;
    }

    public function getProperty(string $key)
    {
        return $this->props[$key];
    }
}