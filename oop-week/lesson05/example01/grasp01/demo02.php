<?php

/** @var Order $order */

if ($order->s == 1 || ($order->s == 2 && $order->d > time() + 3600 * 24)) {

    echo 'button';

}

class Order
{
    public $s;
    public $d;
}