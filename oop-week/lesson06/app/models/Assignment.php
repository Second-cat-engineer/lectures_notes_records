<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%assignment}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $employee_id
 * @property integer $position_id
 * @property string $date
 * @property string $rate
 * @property integer $salary
 * @property bool $active
 *
 * @property Position $position
 * @property Employee $employee
 * @property Order $order
 */
class Assignment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%assignment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['order_id', 'employee_id', 'position_id', 'date', 'rate', 'salary', 'active'],
                'required'
            ],
            [
                ['order_id', 'employee_id', 'position_id', 'salary'],
                'integer'
            ],
            [
                ['active'],
                'boolean'
            ],
            [
                ['date'],
                'safe'
            ],
            [
                ['rate'],
                'number'
            ],
            [
                ['position_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Position::class,
                'targetAttribute' => ['position_id' => 'id']
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
            'position_id' => 'Position',
            'date' => 'Date',
            'rate' => 'Rate',
            'salary' => 'Salary',
            'active' => 'Active',
        ];
    }

    public function getPosition(): ActiveQuery
    {
        return $this->hasOne(Position::class, ['id' => 'position_id']);
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
