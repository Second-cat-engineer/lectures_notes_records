<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%recruit}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $employee_id
 * @property string $date
 *
 * @property Employee $employee
 * @property Order $order
 */
class Recruit extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%recruit}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['order_id', 'employee_id', 'date'],
                'required'
            ],
            [
                ['order_id', 'employee_id'],
                'integer'
            ],
            [
                ['date'],
                'date',
                'format' => 'php:Y-m-d'
            ],
            [
                ['employee_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Employee::class,
                'targetAttribute' => ['employee_id' => 'id']
            ],
            [
                ['order_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Order::class,
                'targetAttribute' => ['order_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order',
            'employee_id' => 'Employee',
            'date' => 'Date',
        ];
    }

    public function getEmployee(): ActiveQuery
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }

    public function getOrder(): ActiveQuery
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }
}
