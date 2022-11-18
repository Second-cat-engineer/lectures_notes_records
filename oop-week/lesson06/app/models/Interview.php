<?php

namespace app\models;
use Yii;
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

    public function getNextStatusList(): array
    {
        if ($this->status == self::STATUS_PASS) {
            return [
                self::STATUS_PASS => 'Passed',
            ];
        } elseif ($this->status == self::STATUS_REJECT) {
            return [
                self::STATUS_PASS => 'Passed',
                self::STATUS_REJECT => 'Rejected',
            ];
        } else {
            return [
                self::STATUS_NEW => 'New',
                self::STATUS_PASS => 'Passed',
                self::STATUS_REJECT => 'Rejected',
            ];
        }
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

    public function reject($reason)
    {
        $this->guardIsNotRejected();
        $this->reject_reason = $reason;
        $this->status = self::STATUS_REJECT;
    }

    private function guardIsNotRejected()
    {
        if ($this->status == self::STATUS_REJECT) {
            throw new \DomainException('Interview is already rejected.');
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (in_array('status', array_keys($changedAttributes)) && $this->status != $changedAttributes['status']) {

            if ($this->status == self::STATUS_NEW) {

                // Логика вынесена в метод joinToInterview() класса StaffService

            } elseif ($this->status == self::STATUS_PASS) {


                if ($this->email) {
                    Yii::$app->mailer->compose('interview/pass', ['model' => $this])
                        ->setFrom(Yii::$app->params['adminEmail'])
                        ->setTo($this->email)
                        ->setSubject('You are passed an interview!')
                        ->send();
                }

                $log = new Log();
                $log->message = $this->last_name . ' ' . $this->first_name . ' is passed an interview';
                $log->save();

            } elseif ($this->status == self::STATUS_REJECT) {

                // Логика вынесена в StaffService
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }
}
