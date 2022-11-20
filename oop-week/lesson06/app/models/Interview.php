<?php

namespace app\models;
use Yii;
use yii\db\ActiveQuery;
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
    const STATUS_NEW = 1;
    const STATUS_PASS = 2;
    const STATUS_REJECT = 3;

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

    public function getEmployee(): ActiveQuery
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }

    public static function join($lastName, $firstName, $email, $date): Interview
    {
        $interview = new Interview();
        $interview->date = $date;
        $interview->last_name = $lastName;
        $interview->first_name = $firstName;
        $interview->email = $email;
        $interview->status = Interview::STATUS_NEW;
        return $interview;
    }

    public function editData($lastName, $firstName, $email)
    {
        $this->last_name = $lastName;
        $this->first_name = $firstName;
        $this->email = $email;
    }

    public function move($date)
    {
        $this->guardIsNew();
        $this->guardNotCurrentDate($date);
        $this->date = $date;
    }

    public function reject($reason)
    {
        $this->guardIsNotRejected();
        $this->reject_reason = $reason;
        $this->status = self::STATUS_REJECT;
    }

    public function passBy(Employee $employee)
    {
        $this->guardIsNotPassed();
        $this->populateRelation('employee', $employee);
        $this->status = self::STATUS_PASS;
    }

    public function remove()
    {

    }

    private function guardNotCurrentDate($date)
    {
        if ($date === $this->date) {
            throw new \DomainException('Date is current.');
        }
    }

    private function guardIsNew()
    {
        if (!$this->isNew()) {
            throw new \DomainException('Interview is not new.');
        }
    }

    private function guardIsNotRejected()
    {
        if (!$this->isRejected()) {
            throw new \DomainException('Interview is already rejected.');
        }
    }

    public function isNew()
    {
        return $this->status === Interview::STATUS_NEW;
    }

    public function isPassed()
    {
        return $this->status === Interview::STATUS_PASS;
    }

    public function isRejected()
    {
        return $this->status === Interview::STATUS_REJECT;
    }

    private function guardIsNotPassed()
    {
        if ($this->isPassed()) {
            throw new \DomainException('Interview is already passed.');
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $related = $this->getRelatedRecords();
            /** @var Employee $employee */
            if (isset($related['employee']) && $employee = $related['employee']) {
                $employee->save();
                $this->employee_id = $employee->id;
            }
            return true;
        }
        return false;
    }
}
