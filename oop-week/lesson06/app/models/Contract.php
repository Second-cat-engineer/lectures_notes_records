<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contract}}".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property string $first_name
 * @property string $last_name
 * @property string $date_open
 * @property string $date_close
 * @property string $close_reason
 */
class Contract extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%contract}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['employee_id', 'first_name', 'last_name', 'date_open'],
                'required'
            ],
            [
                ['employee_id'],
                'integer'
            ],
            [
                ['date_open', 'date_close'],
                'date'
            ],
            [
                ['close_reason'],
                'string'
            ],
            [
                ['first_name', 'last_name'],
                'string',
                'max' => 255
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
            'employee_id' => 'Employee',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'date_open' => 'Date Open',
            'date_close' => 'Date Close',
            'close_reason' => 'Close Reason',
        ];
    }
}
