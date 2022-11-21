<?php

namespace lesson06\example01\demo01;

use yii\db\ActiveRecord;
use Yii;

/**
 * @property $id
 * @property $status
 */
class Order extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PAID = 1;
    const STATUS_SENT = 2;
}

/** @var Order $order */
$order = $this->findModel(5);

#######################################

$order->status = Order::STATUS_PAID;
$order->save();

$order->updateAttributes(['status' => Order::STATUS_PAID]);

Order::updateAll(['status' => Order::STATUS_PAID], ['id' => $order->id]);

Yii::$app->db
    ->createCommand()
    ->update(Order::tableName(), ['status' => Order::STATUS_PAID], ['id' => $order->id])
    ->execute();
