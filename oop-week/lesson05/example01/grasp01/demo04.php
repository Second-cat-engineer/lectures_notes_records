<?php

/** @var Order $order */

if ($order->status == Order::STATUS_NEW || ($order->status == Order::STATUS_PAID && $order->deliveryDate > time() + 3600 * 24)) {

    echo 'button';
}

class Order
{
    const STATUS_NEW = 1;
    const STATUS_PAID = 2;
    const STATUS_SENT = 3;
    const STATUS_CANCEL = 4;

    public $status;
    public $deliveryDate;
}