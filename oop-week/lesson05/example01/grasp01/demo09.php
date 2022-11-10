<?php

/** @var Order $order */

if ($order->isCancelable()) {

    echo '<button>Отменить заказ</button>';
}

class DeliveryDate
{
    private $date;

    public function __construct($date)
    {
        if ($date < time()) {
            // Нельзя создать заказ с прошедшей датой заказа
        }
        return $this->date < $date;
    }

    public function isBefore($date): bool
    {
        return $this->date < $date;
    }
}

class Order
{
    const STATUS_NEW = 1;
    const STATUS_PAID = 2;
    const STATUS_SENT = 3;
    const STATUS_CANCEL = 4;

    public $status;
    /**
     * @var DeliveryDate
     */
    public $deliveryDate;

    public function isNew(): bool
    {
        return $this->status == self::STATUS_NEW;
    }

    public function isPaid(): bool
    {
        return $this->status == self::STATUS_PAID;
    }

    public function isOnDelivery(): bool
    {
        return $this->deliveryDate->isBefore(time() + 3600 * 24);
    }

    public function isCancelable(): bool
    {
        return $this->isNew() || ($this->isPaid() && !$this->isOnDelivery());
    }
}