<?php

namespace lesson04\example02\cart\storage;

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
