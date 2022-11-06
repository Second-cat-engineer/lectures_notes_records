<?php

namespace lesson04\example01\demo04\cart;

class Cart
{
    protected $items;

    public function getItems()
    {
        $this->loadItems();
        return $this->items;
    }

    public function add($id, $count)
    {
        $this->loadItems();
        $current = isset($this->items[$id]) ? $this->items[$id] : 0;
        $this->items[$id] = $current + $count;
        $this->saveItems();
    }

    public function remove($id)
    {
        $this->loadItems();
        if (array_key_exists($id, $this->items)) {
            unset($this->items[$id]);
        }
        $this->saveItems();
    }

    public function clear()
    {
        $this->items = [];
        $this->saveItems();
    }

    protected function loadItems()
    {
        if ($this->items === null) {
            $this->items = isset($_SESSION['cart']) ? unserialize($_SESSION['cart']) : [];
        }
    }

    protected function saveItems()
    {
        $_SESSION['cart'] = serialize($this->items);
    }
}