<?php

namespace lesson06\example01\demo04;

use DateTime;
use yii\db\ActiveRecord;
use Yii;

/**
 * @property $id
 * @property $updated_at
 * @property $paid_at
 * @property $sent_at
 * @property $email
 * @property $status
 */
class Order extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PAID = 1;
    const STATUS_SENT = 2;

    public function pay(DateTime $date)
    {
        if ($this->status === self::STATUS_NEW) {
            $this->status = self::STATUS_PAID;
            $this->paid_at = $date->getTimestamp();
            $this->updated_at = time();
            if ($this->save()) {
                Yii::$app->mailer->compose()->setSubject('Ваш заказ оплачен!')->setTo($this->email)->send();
                return true;
            }
        }
        return false;
    }

    public function send(DateTime $date)
    {
        if ($this->status !== self::STATUS_SENT) {
            $this->status = self::STATUS_SENT;
            $this->sent_at = $date->getTimestamp();
            $this->updated_at = time();
            if ($this->save()) {
                Yii::$app->mailer->compose()->setSubject('Ваш заказ отправлен!')->setTo($this->email)->send();
                return true;
            }
        }
        return false;
    }
}

#######################################

/** @var Order $order */
$order = $this->findModel(5);

$order->pay(new DateTime());
$order->send(DateTime::createFromFormat('2015-08-12', 'Y-m-d'));
