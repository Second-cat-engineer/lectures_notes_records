<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%employee}}".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $email
 * @property integer $status
 *
 * @property Assignment[] $assignments
 * @property Dismiss[] $dismisses
 * @property Bonus[] $bonuses
 * @property Recruit[] $recruits
 * @property Vacation[] $vacations
 */
class Employee extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%employee}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['first_name', 'last_name', 'address', 'status'],
                'required'
            ],
            [
                ['status'],
                'integer'
            ],
            [
                ['first_name', 'last_name', 'address', 'email'],
                'string', 'max' => 255
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'address' => 'Address',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }

    public function getAssignments(): ActiveQuery
    {
        return $this->hasMany(Assignment::class, ['employee_id' => 'id']);
    }

    public function getDismisses(): ActiveQuery
    {
        return $this->hasMany(Dismiss::class, ['employee_id' => 'id']);
    }

    public function getBonuses(): ActiveQuery
    {
        return $this->hasMany(Bonus::class, ['employee_id' => 'id']);
    }

    public function getRecruits(): ActiveQuery
    {
        return $this->hasMany(Recruit::class, ['employee_id' => 'id']);
    }

    public function getVacations(): ActiveQuery
    {
        return $this->hasMany(Vacation::class, ['employee_id' => 'id']);
    }

}
