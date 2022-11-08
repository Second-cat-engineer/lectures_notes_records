<?php

namespace lesson04\example02\cart\storage;

class YiiHybridStorage implements StorageInterface
{
    private $storage;

    public function __construct($sessionKey)
    {
        $sessionStorage = new YiiSessionStorage($sessionKey);

        if (Yii::$app->user->isGuest) {
            $this->storage = $sessionStorage;
        } else {
            $dbStorage = new YiiDbStorage(Yii::$app->user->id);
            if ($sessionItems = $sessionStorage->load()) {
                $items = array_merge($dbStorage->load(), $sessionItems);
                $dbStorage->save($items);
                $sessionStorage->save([]);
            }
            $this->storage = $dbStorage;
        }
    }

    public function load()
    {
        return $this->storage->load();
    }

    public function save(array $items)
    {
        $this->storage->save($items);
    }
}
