<?php

namespace lesson04\example01\demo04\cart;

class YiiHybridCart extends Cart
{
    public $sessionKey = 'cart';
    public $tableName = '{{%cart}}';

    protected function loadItems()
    {
        if ($this->items === null) {
            if ($user = Yii::$app->user->identity) {
                $this->items = (new Query())
                    ->select('count', 'product_id')
                    ->from($this->tableName)
                    ->indexBy('product_id')
                    ->where(['user_id' => $user->getId()])
                    ->column();
            } else {
                $this->items = Yii::$app->session->get($this->sessionKey, []);
            }
        }
    }

    protected function saveItems()
    {
        if ($user = Yii::$app->user->identity) {
            Yii::$app->db->createCommand()->delete($this->tableName, ['user_id' => $user->getId()])->execute();
            foreach ($this->items as $productId => $count) {
                Yii::$app->db->createCommand()->insert($this->tableName, [
                    'user_id' => Yii::$app->user->id,
                    'product_id' => $productId,
                    'count' => $count,
                ])->execute();
            }
        } else {
            Yii::$app->session->set($this->sessionKey, $this->items);
        }
    }

}