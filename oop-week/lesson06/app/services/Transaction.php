<?php

namespace app\services;

class Transaction
{
    private $transaction;

    public function __construct(\yii\db\Transaction $transaction){

        $this->transaction = $transaction;
    }

    public function commit(): void
    {
        $this->transaction->commit();
    }

    public function rollBack(): void
    {
        $this->transaction->rollBack();
    }
}