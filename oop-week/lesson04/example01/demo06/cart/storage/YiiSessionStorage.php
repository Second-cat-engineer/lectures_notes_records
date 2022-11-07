<?php

namespace lesson04\example01\demo06\cart\storage;

use lesson04\example01\demo06\cart\StorageInterface;

class YiiSessionStorage implements StorageInterface
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function load()
    {
        return Yii::$app->session->get($this->key, []);
    }

    public function save(array $items)
    {
        Yii::$app->session->set($this->key, $items);
    }
}
