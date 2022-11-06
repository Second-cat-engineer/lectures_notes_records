<?php

namespace lesson04\example01\demo05\cart;

class Cart
{
    /** @var CartItem[] */
    private $items;

    public function getItems()
    {
        $this->loadItems();
        return $this->items;
    }

    public function add($id, $count, $price)
    {
        $this->loadItems();
        $current = isset($this->items[$id]) ? $this->items[$id]->getCount() : 0;
        $this->items[$id] = new CartItem($id, $current + $count, $price);
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

    public function getCost()
    {
        $this->loadItems();
        $cost = 0;
        foreach ($this->items as $item) {
            $cost += $item->getCost();
        }
        return $cost;
    }

    private function loadItems()
    {
        if ($this->items === null) {
            $this->items = isset($_SESSION['cart']) ? unserialize($_SESSION['cart']) : [];
        }
    }

    private function saveItems()
    {
        $_SESSION['cart'] = serialize($this->items);
    }

}