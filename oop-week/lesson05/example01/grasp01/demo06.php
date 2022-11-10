<?php

/** @var Order $order */

if ($order->isNew() || ($order->isPaid() && $order->deliveryDate > time() + 3600 * 24)) {

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

    public function isNew(): bool
    {
        return $this->status == self::STATUS_NEW;
    }

    public function isPaid(): bool
    {
        return $this->status == self::STATUS_PAID;
    }
}