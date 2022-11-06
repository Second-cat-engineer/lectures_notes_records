<?php

namespace lesson04\example01\demo04\cart;

class YiiCart extends Cart
{
    public string $sessionKey = 'cart';

    protected function loadItems()
    {
        if ($this->items === null) {
            $this->items = Yii::$app->session->get($this->sessionKey, []);
        }
    }

    protected function saveItems()
    {
        Yii::$app->session->set($this->sessionKey, $this->items);
    }
}