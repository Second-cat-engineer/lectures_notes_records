<?php

namespace lesson04\example02\demo04;

use ReflectionClass;

class Container
{
    private $definitions = [];
    private $shared = [];

    public function set($id, $value)
    {
        $this->shared[$id] = null;
        $this->definitions[$id] = [
            'value' => $value,
            'shared' => false,
        ];
    }

    public function setShared($id, $value)
    {
        $this->shared[$id] = null;
        $this->definitions[$id] = [
            'value' => $value,
            'shared' => true,
        ];
    }

    public function get($id)
    {
        if (isset($this->shared[$id])) {
            return $this->shared[$id];
        }

        if (array_key_exists($id, $this->definitions)) {
            $value = $this->definitions[$id]['value'];
            $shared = $this->definitions[$id]['shared'];
        } else {
            $value = $id;
            $shared = false;
        }

        if (is_string($value)) {
            $reflection = new ReflectionClass($value);
            $arguments = [];
            if (($constructor = $reflection->getConstructor()) !== null) {
                foreach ($constructor->getParameters() as $param) {
                    $paramClass = $param->getClass();
                    $arguments[] = $paramClass ? $this->get($paramClass->getName()) : null;
                }
            }
            $component = $reflection->newInstanceArgs($arguments);
        } else {
            $component = call_user_func($value, $this);
        }

        if (!$component) {
            throw new \Exception('Undefined component ' . $id);
        }

        if ($shared) {
            $this->shared[$id] = $component;
        }

        return $component;
    }
}