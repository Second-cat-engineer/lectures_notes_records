<?php

namespace lesson06\example01\demo03;

use yii\db\ActiveRecord;
use Yii;

/**
 * @property $id
 * @property $updated_at
 * @property $email
 * @property $status
 */
class Order extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PAID = 1;
    const STATUS_SENT = 2;

    public function changeStatus($status)
    {
        if ($status !== $this->status) {
            $this->status = $status;
            $this->updated_at = time();
            if ($this->save()) {
                Yii::$app->mailer->compose()->setSubject('Статус заказа изменён!')->setTo($this->email)->send();
                return true;
            }
        }
        return false;
    }
}

#######################################

/** @var Order $order */
$order = $this->findModel(5);

$order->changeStatus(Order::STATUS_PAID);
