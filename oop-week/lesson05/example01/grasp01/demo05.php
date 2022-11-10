<?php

/** @var Order $order */

if ($order->isNew() || ($order->status == Order::STATUS_PAID && $order->deliveryDate > time() + 3600 * 24)) {

    echo 'button';
}

class Order
{
    const STATUS_NEW = 1;
    const STATUS_PAID = 2;
    const STATUS_SENT = 3;

    public $status;
    public $deliveryDate;

    public function isNew(): bool
    {
        return $this->status == self::STATUS_NEW;
    }
}