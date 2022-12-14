<?php

namespace app\models;

use Yii;
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
    const STATUS_PROBATION = 1;
    const STATUS_WORK = 2;
    const STATUS_VACATION = 3;
    const STATUS_DISMISS = 4;

    const SCENARIO_CREATE = 'create';

    public $order_date;
    public $contract_date;
    public $recruit_date;

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
            [
                ['order_date', 'contract_date', 'recruit_date'],
                'required',
                'on' => self::SCENARIO_CREATE
            ],
            [
                ['order_date', 'contract_date', 'recruit_date'],
                'date',
                'on' => self::SCENARIO_CREATE
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
            'order_date' => 'Order Date',
            'contract_date' => 'Contract Date',
            'recruit_date' => 'Recruit Date',
        ];
    }

    public function getFullName(): string
    {
        return $this->last_name . ' ' . $this->first_name;
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

    public static function create($firstName, $lastName, $address, $email): Employee
    {
        $employee = new self();
        $employee->first_name = $firstName;
        $employee->last_name = $lastName;
        $employee->address = $address;
        $employee->email = $email;
        $employee->status = self::STATUS_PROBATION;

        return $employee;
    }
}
