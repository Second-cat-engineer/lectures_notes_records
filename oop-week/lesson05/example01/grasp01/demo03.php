<?php

/** @var Order $order */

if ($order->status == 1 || ($order->status == 2 && $order->deliveryDate > time() + 3600 * 24)) {

    echo 'button';
}

class Order
{
    public $status;
    public $deliveryDate;
}