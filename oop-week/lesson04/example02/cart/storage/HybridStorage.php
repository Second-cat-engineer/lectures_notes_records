<?php

namespace lesson04\example02\cart\storage;

class HybridStorage implements StorageInterface
{
    private $storage;

    public function __construct(StorageInterface $from, StorageInterface $to)
    {
        $items = array_merge($from->load(), $to->load());
        $from->save([]);
        $to->save($items);
        $this->storage = $to;
    }

    public function load()
    {
        return $this->storage->load();
    }

    public function save(array $tems)
    {
        $this->storage->save($tems);
    }
}
