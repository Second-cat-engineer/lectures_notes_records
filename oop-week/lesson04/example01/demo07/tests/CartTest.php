<?php

namespace lesson04\example01\demo07\tests;

use lesson04\example01\demo07\cart\Cart;
use lesson04\example01\demo07\cart\cost\SimpleCost;
use lesson04\example01\demo07\cart\storage\StorageInterface;
use PHPUnit\Framework\TestCase;

class MemoryStorage implements StorageInterface
{
    private $items = [];

    public function load() {
        return $this->items;
    }

    public function save(array $items) {
        $this->items = $items;
    }
}

class CartTest extends TestCase
{
    private $cart;

    public function setUp(): void
    {
        $this->cart = new Cart(new MemoryStorage(), new SimpleCost());
        parent::setUp();
    }

    public function testCreate()
    {
        $this->assertEquals([], $this->cart->getItems());
    }

    public function testAdd()
    {
        $this->cart->add(5, 3, 100);
        $this->assertEquals(1, count($items = $this->cart->getItems()));
        $this->assertEquals(5, $items[5]->getId());
        $this->assertEquals(3, $items[5]->getCount());
        $this->assertEquals(100, $items[5]->getPrice());
    }

    public function testAddExist()
    {
        $this->cart->add(5, 3, 100);
        $this->cart->add(5, 4, 100);
        $this->assertEquals(1, count($items = $this->cart->getItems()));
        $this->assertEquals(7, $items[5]->getCount());
    }

    public function testRemove()
    {
        $this->cart->add(5, 3, 100);
        $this->cart->remove(5);
        $this->assertEquals([], $this->cart->getItems());
    }

    public function testClear()
    {
        $this->cart->add(5, 3, 100);
        $this->cart->clear();
        $this->assertEquals([], $this->cart->getItems());
    }

    public function testCost()
    {
        $this->cart->add(5, 3, 100);
        $this->cart->add(6, 4, 150);
        $this->assertEquals(900, $this->cart->getCost());
    }
}
