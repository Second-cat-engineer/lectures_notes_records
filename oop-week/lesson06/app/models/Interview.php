<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%interview}}".
 *
 * @property integer $id
 * @property string $date
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property integer $status
 * @property string $reject_reason
 * @property integer $employee_id
 */
class Interview extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%interview}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['date', 'first_name', 'last_name', 'status'],
                'required'
            ],
            [
                ['date'],
                'safe'
            ],
            [
                ['status', 'employee_id'],
                'integer'
            ],
            [
                ['first_name', 'last_name', 'email'],
                'string',
                'max' => 255
            ],
            [
                ['reject_reason'],
                'string'
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
            'date' => 'Date',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'status' => 'Status',
            'reject_reason' => 'Reject Reason',
            'employee_id' => 'Employee',
        ];
    }
}
