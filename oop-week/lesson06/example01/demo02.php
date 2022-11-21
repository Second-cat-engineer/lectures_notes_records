<?php

namespace lesson06\example01\demo02;

use yii\db\ActiveRecord;
use Yii;

/**
 * @property $id
 * @property $email
 * @property $status
 */
class Order extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PAID = 1;
    const STATUS_SENT = 2;

    public function afterSave($insert, $changedAttributes)
    {
        if (array_key_exists('status', $changedAttributes)) {
            Yii::$app->mailer->compose()->setSubject('Статус заказа изменён!')->setTo($this->email)->send();
        }
        parent::afterSave($insert, $changedAttributes);
    }
}

#######################################

/** @var Order $order */
$order = $this->findModel(5);

$order->status = Order::STATUS_PAID;
$order->save();


$order->updateAttributes(['status' => Order::STATUS_PAID]);


Order::updateAll(['status' => Order::STATUS_PAID], ['id' => $order->id]);


Yii::$app->db
    ->createCommand()
    ->update(Order::tableName(), ['status' => Order::STATUS_PAID], ['id' => $order->id])
    ->execute();
