<?php

namespace app\services;

class TransactionManager
{
    public function begin(): Transaction
    {
        return new Transaction(\Yii::$app->db->beginTransaction());
    }
}