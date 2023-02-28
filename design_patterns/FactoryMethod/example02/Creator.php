<?php

namespace FactoryMethod\example02;

abstract class Creator
{
    abstract public function factoryMethod(): Product;

    public function someOperation(): string
    {
        // Вызываем фабричный метод, чтобы получить объект-продукт.
        $product = $this->factoryMethod();
        // Далее, работаем с этим продуктом.
        return "Creator: The same creator's code has just worked with " . $product->operation();
    }
}