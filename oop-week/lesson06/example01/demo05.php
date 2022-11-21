<?php

namespace lesson06\example01\demo05;

use DateTime;
use yii\db\ActiveRecord;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
        if ($this->status === self::STATUS_PAID) {
            throw new \DomainException('Заказ уже оплачен');
        }
        $this->status = self::STATUS_PAID;
        $this->paid_at = $date->getTimestamp();
        $this->updated_at = time();
        if (!$this->save()) {
            throw new \RuntimeException('Ошибка сохранения');
        }
    }

    public function send(DateTime $date)
    {
        if ($this->status === self::STATUS_SENT) {
            throw new \DomainException('Заказ уже отправлен');
        }
        $this->status = self::STATUS_SENT;
        $this->sent_at = $date->getTimestamp();
        $this->updated_at = time();
        if (!$this->save()) {
            throw new \RuntimeException('Ошибка сохранения');
        }
    }
}

#######################################

class OrderController extends Controller
{
    public function actionPay($id)
    {
        $order = $this->findModel($id);
        try {
            $order->pay(new DateTime());
            Yii::$app->mailer->compose()
                ->setSubject('Ваш заказ оплачен!')
                ->setTo($order->email)
                ->send();
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    private function findModel($id)
    {
        if (!$order = Order::findOne($id)) {
            throw new NotFoundHttpException('Заказ не найден');
        }
        return $order;
    }
}
